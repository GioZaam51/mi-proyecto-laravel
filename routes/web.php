<?php


use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SaleController::class, 'index']);                            // Página principal
Route::get('/catalogo', [ProductController::class, 'catalog'])->name('catalog');   // Catálogo
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('products.show'); // Detalle
Route::get('/venta', [SaleController::class, 'create'])->name('sales.create');
Route::post('/venta', [SaleController::class, 'store'])->name('sales.store');

// Carrito (session-based)
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/carrito/actualizar/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');

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
