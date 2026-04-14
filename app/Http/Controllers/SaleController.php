<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;

class SaleController extends Controller
{
    /** Página principal */
    public function index()
    {
        $products = Product::latest()->take(4)->get();
        return view('index', ['products' => $products]);
    }

    /** Checkout: muestra los ítems del carrito con desglose de IVA */
    public function create()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('success', 'Tu carrito está vacío.');
        }

        // Cargar productos y calcular totales
        $items = collect($cart)->map(function ($data, $productId) {
            $product = Product::find($productId);
            if (!$product) return null;
            $qty       = $data['quantity'];
            $lineTotal = $product->price * $qty;
            return [
                'product'    => $product,
                'quantity'   => $qty,
                'img_idx'    => $data['img_idx'] ?? 0,
                'unit_price' => $product->price,
                'line_total' => $lineTotal,
            ];
        })->filter()->values();

        $subtotal = $items->sum('line_total');
        $iva      = round($subtotal * 0.16, 2);
        $total    = round($subtotal + $iva, 2);

        return view('ventas', compact('items', 'subtotal', 'iva', 'total'));
    }

    /** Procesa y persiste la venta */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $request->validate([
            'buyer_name' => 'nullable|string|max:100',
        ]);

        // Recalcular totales desde la sesión (nunca del form)
        $items = collect($cart)->map(function ($data, $productId) {
            $product = Product::find($productId);
            if (!$product) return null;
            $qty       = (int) $data['quantity'];
            $lineTotal = round($product->price * $qty, 2);
            return [
                'product'    => $product,
                'quantity'   => $qty,
                'unit_price' => $product->price,
                'line_total' => $lineTotal,
            ];
        })->filter()->values();

        $subtotal = round($items->sum('line_total'), 2);
        $iva      = round($subtotal * 0.16, 2);
        $total    = round($subtotal + $iva, 2);

        // Guardar la venta en BD
        $sale = Sale::create([
            'buyer_name' => $request->buyer_name ?: null,
            'subtotal'   => $subtotal,
            'iva'        => $iva,
            'total'      => $total,
        ]);

        // Guardar cada ítem
        foreach ($items as $item) {
            SaleItem::create([
                'sale_id'      => $sale->id,
                'product_id'   => $item['product']->id,
                'product_name' => $item['product']->name,
                'unit_price'   => $item['unit_price'],
                'quantity'     => $item['quantity'],
                'line_total'   => $item['line_total'],
            ]);
        }

        // Limpiar carrito
        session()->forget('cart');

        return redirect()->route('sales.confirmation', $sale->id);
    }

    /** Pantalla de confirmación post-compra */
    public function confirmation(Sale $sale)
    {
        $sale->load('items');
        return view('ventas.confirmacion', compact('sale'));
    }

    /* ── ADMIN ─────────────────────────────────── */

    /** Lista de ventas en panel admin */
    public function adminIndex()
    {
        $sales = Sale::with('items')->latest()->get();
        return view('ventas.index', compact('sales'));
    }

    /** Detalle de una venta en panel admin */
    public function adminShow(Sale $sale)
    {
        $sale->load('items.product');
        return view('ventas.show', compact('sale'));
    }
}
