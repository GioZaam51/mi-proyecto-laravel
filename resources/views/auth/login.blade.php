@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            
            <div class="auth-form-container p-4 p-md-5 mt-4" style="background: var(--verde-mid); border: 1px solid var(--border);">
                
                <div class="text-center mb-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border: 1px solid var(--dorado-dim); background: rgba(201,168,76,0.1); color: var(--dorado);">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <p class="section-label mb-1" style="font-size: 0.65rem;">— Acceso Restringido</p>
                    <h2 class="section-title fs-3 m-0">Administración</h2>
                </div>

                @if($errors->any())
                <div class="alert text-center fw-bold text-uppercase border-0 rounded-0" style="background: rgba(220, 53, 69, 0.1); color: #ea868f; font-family: 'Space Mono', monospace; font-size: 0.70rem; letter-spacing: 0.05em;" role="alert">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="form-label text-uppercase" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.1em;">Correo Electrónico</label>
                        <input type="email" class="form-control rounded-0 text-white bg-transparent p-3" id="email" name="email" style="border: 1px solid var(--border); font-family: 'DM Sans', sans-serif;" value="{{ old('email') }}" placeholder="admin@tiendafca.unam.mx" required autofocus>
                    </div>

                    <div class="mb-5">
                        <label for="password" class="form-label text-uppercase d-flex justify-content-between" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.1em;">
                            Contraseña
                        </label>
                        <input type="password" class="form-control rounded-0 text-white bg-transparent p-3" id="password" name="password" style="border: 1px solid var(--border); font-family: 'DM Sans', sans-serif;" placeholder="••••••••" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary-fca w-100 py-3">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-4">
                <a href="/" class="text-decoration-none" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.75rem; letter-spacing: 0.05em;">← Volver al inicio</a>
            </div>

        </div>
    </div>
</div>
@endsection
