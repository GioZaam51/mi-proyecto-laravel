<?php


use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SaleController::class, 'index']); // Página principal
Route::get('/venta', [SaleController::class, 'create'])->name('sales.create'); // Mostrar formulario de venta
Route::post('/venta', [SaleController::class, 'store'])->name('sales.store'); // Para procesar el formulario

// Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registro de productos (Protegido para administradores)
Route::middleware('auth')->group(function () {
    Route::get('/admin/productos', [ProductController::class, 'index'])->name('products.index');
    Route::get('/admin/productos/crear', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin/productos', [ProductController::class, 'store'])->name('products.store');
});
