<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class SaleController extends Controller
{
    public function index() {
        $products = Product::latest()->take(4)->get();
        return view('index', ['products' => $products]);
    }

    public function create() {
        return view('ventas');
    }

    public function store(Request $request) {
    // 1. Validaciones 
    $request->validate([
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:1',
    ]);

    // 2. Cálculo automático 
    $subtotal = $request->price * $request->quantity;
    $iva = $subtotal * 0.16;
    $total = $subtotal + $iva;

    // 3. Guardar en BD 
    $sale = new Sale();
    $sale->subtotal = $subtotal;
    $sale->iva = $iva;
    $sale->total = $total;
    $sale->save();

    return back()->with('success', 'Venta registrada con éxito');
}
}
