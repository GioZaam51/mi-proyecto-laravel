@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            
            <div class="auth-form-container p-4 p-md-5 mt-4" style="background: var(--verde-mid); border: 1px solid var(--border);">
                
                <div class="text-center mb-4">
                    <div class="auth-icon mx-auto mb-3">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <p class="section-label mb-1">— Acceso Restringido</p>
                    <h2 class="section-title fs-3 m-0">Administración</h2>
                </div>

                @if($errors->any())
                <div class="alert alert-fca-error text-center fw-bold text-uppercase" role="alert">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="form-label label-fca">Correo Electrónico</label>
                        <input type="email" class="form-control rounded-0 text-white bg-transparent p-3 input-fca" id="email" name="email" value="{{ old('email') }}" placeholder="admin@tiendafca.unam.mx" required autofocus>
                    </div>

                    <div class="mb-5">
                        <label for="password" class="form-label label-fca d-flex justify-content-between">
                            Contraseña
                        </label>
                        <input type="password" class="form-control rounded-0 text-white bg-transparent p-3 input-fca" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary-fca w-100 py-3">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-4">
                <p class="uted mb-2" style="font-size: 0.82rem;">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="register-link">Regístrate aquí</a>
                </p>
                <a href="/" class="show-back-link text-decoration-none">← Volver al inicio</a>
            </div>

        </div>
    </div>
</div>
@endsection
