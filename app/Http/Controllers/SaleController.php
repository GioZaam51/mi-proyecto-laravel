<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index() {
        return view('index', ['products' => collect([])]);
    }

    public function create() {
        return view('ventas');
    }

    public function store(Request $request) {
    // 1. Validaciones (Punto 4 de tu examen)
    $request->validate([
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:1',
    ]);

    // 2. Cálculo automático (Punto 1 de tu examen)
    $subtotal = $request->price * $request->quantity;
    $iva = $subtotal * 0.16;
    $total = $subtotal + $iva;

    // 3. Guardar en BD (Modelo)
    $sale = new Sale();
    $sale->subtotal = $subtotal;
    $sale->iva = $iva;
    $sale->total = $total;
    $sale->save();

    return back()->with('success', 'Venta registrada con éxito');
}
}
