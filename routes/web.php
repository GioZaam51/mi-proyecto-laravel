<?php


use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SaleController::class, 'index']); // Página principal
Route::get('/venta', [SaleController::class, 'create'])->name('sales.create'); // Mostrar formulario de venta
Route::post('/venta', [SaleController::class, 'store'])->name('sales.store'); // Para procesar el formulario
