<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** Mostrar el carrito */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Cargar los productos de BD
        $products = collect($cart)->map(function ($item, $productId) {
            $product = Product::find($productId);
            if (!$product) return null;
            return [
                'product'  => $product,
                'quantity' => $item['quantity'],
                'img_idx'  => $item['img_idx'] ?? 0,
                'subtotal' => $product->price * $item['quantity'],
            ];
        })->filter()->values();

        $total = $products->sum('subtotal');

        return view('cart', compact('products', 'total'));
    }

    /** Agregar producto al carrito */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
            'img_idx'  => 'nullable|integer|min:0',
        ]);

        $cart = session()->get('cart', []);
        $qty = (int) $request->quantity;
        $imgIdx = (int) ($request->img_idx ?? 0);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'quantity' => $qty,
                'img_idx'  => $imgIdx,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', "«{$product->name}» agregado al carrito.");
    }

    /** Actualizar cantidad */
    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:99']);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = (int) $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    /** Eliminar producto del carrito */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Producto eliminado del carrito.');
    }

    /** Vaciar carrito */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')
            ->with('success', 'Carrito vaciado.');
    }
}
