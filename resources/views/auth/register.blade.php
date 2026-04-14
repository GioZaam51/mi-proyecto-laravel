@extends('layouts.app')

@section('title', 'Crear Cuenta')

@section('content')
<div class="register-page d-flex align-items-center justify-content-center px-4 py-5">

    {{-- Decorative background glow --}}
    <div class="register-glow" aria-hidden="true"></div>

    <div class="register-card w-100">

        {{-- Header --}}
        <div class="text-center mb-5">
            <div class="register-icon mx-auto mb-4" aria-hidden="true">
                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
            </div>
            <p class="section-label mb-2">— Únete a la comunidad</p>
            <h1 class="register-title">Crear Cuenta</h1>
            <p class="uted mt-2 mb-0" style="font-size: 0.9rem; max-width: 340px; margin-inline: auto;">
                Accede a la tienda oficial de la Facultad de Contaduría y Administración, UNAM.
            </p>
        </div>

        {{-- Error alert --}}
        @if($errors->any())
            <div class="alert alert-fca-error text-center fw-bold text-uppercase mb-4" role="alert">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('register') }}" method="POST" id="registerForm" novalidate>
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="form-label label-fca">Nombre completo</label>
                <input
                    type="text"
                    class="form-control rounded-0 text-white bg-transparent p-3 input-fca @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Ej: Juan García López"
                    required
                    autocomplete="name"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="form-label label-fca">Correo electrónico</label>
                <input
                    type="email"
                    class="form-control rounded-0 text-white bg-transparent p-3 input-fca @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="tu@correo.unam.mx"
                    required
                    autocomplete="email"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="form-label label-fca">Contraseña</label>
                <div class="position-relative">
                    <input
                        type="password"
                        class="form-control rounded-0 text-white bg-transparent p-3 input-fca @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="Mínimo 8 caracteres"
                        required
                        autocomplete="new-password"
                    >
                    <button type="button" class="register-toggle-pw" id="togglePwd" aria-label="Mostrar/ocultar contraseña">
                        <svg id="eyeIcon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                {{-- Strength indicator --}}
                <div class="register-strength mt-2" id="strengthBar" aria-hidden="true">
                    <div class="register-strength-fill" id="strengthFill"></div>
                </div>
                <p class="register-strength-label mt-1" id="strengthLabel"></p>
            </div>

            {{-- Confirm Password --}}
            <div class="mb-5">
                <label for="password_confirmation" class="form-label label-fca">Confirmar contraseña</label>
                <input
                    type="password"
                    class="form-control rounded-0 text-white bg-transparent p-3 input-fca"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repite tu contraseña"
                    required
                    autocomplete="new-password"
                >
            </div>

            {{-- Terms note --}}
            <p class="register-terms mb-4">
                Al registrarte aceptas los <a href="#">términos de uso</a> y la <a href="#">política de privacidad</a> de Tienda FCA.
            </p>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary-fca w-100 py-3" id="submitBtn">
                    Crear cuenta
                </button>
            </div>
        </form>

        {{-- Footer links --}}
        <div class="register-footer mt-5 pt-4 text-center">
            <p class="uted" style="font-size: 0.82rem;">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="register-link">Iniciar sesión</a>
            </p>
            <a href="/" class="show-back-link d-inline-block mt-2">← Volver al inicio</a>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    /* ── Register Page Layout ── */
    .register-page {
        min-height: 100vh;
        padding-top: 100px;
        background: var(--verde);
        position: relative;
        overflow: hidden;
    }

    .register-glow {
        position: absolute;
        top: -180px;
        left: 50%;
        transform: translateX(-50%);
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    .register-card {
        max-width: 520px;
        background: var(--verde-mid);
        border: 1px solid var(--border);
        padding: 3rem 3.5rem;
        position: relative;
        z-index: 1;
        /* subtle top accent line */
        box-shadow: 0 -2px 0 0 var(--dorado), 0 20px 60px rgba(0,0,0,0.35);
        animation: fadeUp 0.7s ease both;
    }

    @media (max-width: 576px) {
        .register-card { padding: 2rem 1.5rem; }
    }

    /* ── Icon ── */
    .register-icon {
        width: 56px;
        height: 56px;
        border: 1px solid var(--border);
        background: var(--dorado-dim);
        color: var(--dorado);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ── Title ── */
    .register-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2rem, 5vw, 2.6rem);
        font-weight: 700;
        color: var(--crema);
        line-height: 1.1;
        margin: 0;
    }

    /* ── Toggle password ── */
    .register-toggle-pw {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: var(--muted);
        cursor: pointer;
        padding: 0;
        transition: color 0.2s;
    }
    .register-toggle-pw:hover { color: var(--dorado); }

    /* ── Strength bar ── */
    .register-strength {
        height: 3px;
        background: rgba(248,245,238,0.08);
        border-radius: 2px;
        overflow: hidden;
    }
    .register-strength-fill {
        height: 100%;
        width: 0%;
        border-radius: 2px;
        transition: width 0.4s, background 0.4s;
    }
    .register-strength-label {
        font-family: 'Space Mono', monospace;
        font-size: 0.58rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--muted);
        margin: 0;
        min-height: 1em;
    }

    /* ── Terms ── */
    .register-terms {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.78rem;
        color: var(--muted);
        line-height: 1.6;
    }
    .register-terms a {
        color: var(--dorado);
        text-decoration: none;
    }
    .register-terms a:hover { text-decoration: underline; }

    /* ── Footer ── */
    .register-footer {
        border-top: 1px solid var(--border);
    }
    .register-link {
        color: var(--dorado);
        text-decoration: none;
        font-weight: 500;
    }
    .register-link:hover { text-decoration: underline; }
</style>
@endpush

@push('scripts')
<script>
    // ── Toggle password visibility ──
    const pwd       = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePwd');
    const eyeIcon   = document.getElementById('eyeIcon');

    toggleBtn?.addEventListener('click', () => {
        const isPassword = pwd.type === 'password';
        pwd.type = isPassword ? 'text' : 'password';
        eyeIcon.innerHTML = isPassword
            ? '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
            : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    });

    // ── Password strength indicator ──
    const strengthFill  = document.getElementById('strengthFill');
    const strengthLabel = document.getElementById('strengthLabel');

    const strengthColors = ['#e55', '#e8853a', '#d4b63c', '#7db87d', '#4cae6e'];
    const strengthLabels = ['', 'Muy débil', 'Débil', 'Moderada', 'Fuerte', 'Muy fuerte'];

    function getStrength(pw) {
        let score = 0;
        if (pw.length >= 8)  score++;
        if (pw.length >= 12) score++;
        if (/[A-Z]/.test(pw)) score++;
        if (/[0-9]/.test(pw)) score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;
        return score;
    }

    pwd?.addEventListener('input', () => {
        const score = getStrength(pwd.value);
        const pct   = Math.min(score * 20, 100);
        strengthFill.style.width      = pct + '%';
        strengthFill.style.background = strengthColors[score - 1] ?? 'transparent';
        strengthLabel.textContent     = pwd.value.length ? (strengthLabels[score] ?? '') : '';
    });
</script>
@endpush
