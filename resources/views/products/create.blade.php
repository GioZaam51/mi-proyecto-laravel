@extends('layouts.app')

@section('title', 'Registro de Producto')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="product-form-container p-4 p-md-5" style="background: var(--verde-mid); border: 1px solid var(--border);">
                
                <div class="text-center mb-4">
                    <p class="section-label mb-2">— Panel de Administración</p>
                    <h2 class="section-title fs-3 m-0">Registrar Producto</h2>
                    <p class="uted mt-2 mb-0" style="font-size: 0.9rem;">Ingresa los datos del nuevo producto FCA.</p>
                </div>

                @if(session('success'))
                <div class="alert text-center fw-bold text-uppercase border-0 rounded-0" style="background: var(--dorado-dim); color: var(--dorado); font-family: 'Space Mono', monospace; font-size: 0.75rem; letter-spacing: 0.1em;" role="alert">
                    ✦ {{ session('success') }} ✦
                </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="form-label text-uppercase" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.1em;">Nombre del Producto</label>
                        <input type="text" class="form-control rounded-0 text-white bg-transparent p-3 @error('name') is-invalid @enderror" id="name" name="name" style="border: 1px solid var(--border); font-family: 'DM Sans', sans-serif;" value="{{ old('name') }}" placeholder="Ej: Sudadera Básica FCA" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="price" class="form-label text-uppercase" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.1em;">Precio (MXN)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent rounded-0 text-white border-end-0" style="border: 1px solid var(--border);">$</span>
                            <input type="number" step="0.01" min="0" class="form-control rounded-0 text-white bg-transparent p-3 border-start-0 @error('price') is-invalid @enderror" id="price" name="price" style="border: 1px solid var(--border); font-family: 'DM Sans', sans-serif;" value="{{ old('price') }}" placeholder="Ej: 599.00" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="description" class="form-label text-uppercase" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.1em;">Descripción</label>
                        <textarea class="form-control rounded-0 text-white bg-transparent p-3 @error('description') is-invalid @enderror" id="description" name="description" rows="4" style="border: 1px solid var(--border); font-family: 'DM Sans', sans-serif;" placeholder="Escribe los detalles del producto..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary-fca w-100 py-3">Registrar Producto</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
