@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="container py-5 mt-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-3 border-bottom" style="border-color: var(--border) !important;">
        <div>
            <p class="section-label mb-2">— Panel de Control</p>
            <h2 class="section-title m-0 fs-2">Tus Productos</h2>
            <p class="uted mt-2 mb-0" style="font-size: 0.9rem;">Gestión del inventario de la tienda FCA.</p>
        </div>
        <div class="mt-4 mt-md-0 d-flex gap-2">
            <a href="{{ route('sales.index') }}" class="btn-outline-fca">Ver Ventas</a>
            <a href="{{ route('products.create') }}" class="btn-primary-fca">Registrar Nuevo Producto</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-fca-success text-center fw-bold text-uppercase mb-4" role="alert">
        ❖ {{ session('success') }} ❖
    </div>
    @endif

    <div class="table-responsive border-fca">
        <table class="table table-dark table-hover table-fca m-0">
            <thead class="table-fca-head">
                <tr>
                    <th scope="col" class="py-3 px-4 border-bottom-0 text-muted" style="border-color: var(--border) !important; width: 60px;">ID</th>
                    <th scope="col" class="py-3 px-4 border-bottom-0 text-muted" style="border-color: var(--border) !important;">Nombre</th>
                    <th scope="col" class="py-3 px-4 border-bottom-0 text-muted" style="border-color: var(--border) !important;">Descripción</th>
                    <th scope="col" class="py-3 px-4 border-bottom-0 text-muted text-end" style="border-color: var(--border) !important;">Precio</th>
                </tr>
            </thead>
            <tbody style="border-top: 1px solid var(--border); font-family: 'DM Sans', sans-serif;">
                @forelse($products as $product)
                    <tr>
                        <td class="py-3 px-4" style="border-color: var(--border) !important; color: var(--dorado);">#{{ $product->id }}</td>
                        <td class="py-3 px-4 fw-bold" style="border-color: var(--border) !important;">{{ $product->name }}</td>
                        <td class="py-3 px-4 text-white-50" style="border-color: var(--border) !important;">{{ Str::limit($product->description, 50) }}</td>
                        <td class="py-3 px-4 text-end" style="border-color: var(--border) !important;">${{ number_format($product->price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-5 text-center text-muted" style="border-color: var(--border) !important;">
                            <p class="mb-2">Aún no tienes productos registrados en el inventario.</p>
                            <a href="{{ route('products.create') }}" style="color: var(--dorado); text-decoration: none;">Comienza registrando el primero aquí →</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
