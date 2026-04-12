@extends('layouts.app')

@section('title', 'Mi Carrito')

@push('styles')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <style>
        /* ── Cart Page ── */
        .cart-page {
            min-height: 100vh;
            padding-top: 110px;
            background: var(--verde);
        }
        .cart-page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            color: var(--crema);
            line-height: 1.1;
        }
        /* ── Cart Item ── */
        .cart-item {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border);
        }
        .cart-item-img {
            width: 100px;
            height: 130px;
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
            background: rgba(201,168,76,0.05);
        }
        .cart-item-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--crema);
            line-height: 1.3;
        }
        .cart-item-price {
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            color: var(--dorado);
            letter-spacing: 0.05em;
        }
        .cart-qty {
            display: flex;
            align-items: center;
            border: 1px solid var(--border);
            width: fit-content;
        }
        .cart-qty button {
            width: 32px;
            height: 32px;
            background: transparent;
            border: none;
            color: var(--crema);
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .cart-qty button:hover { background: var(--dorado-dim); }
        .cart-qty input {
            width: 40px;
            height: 32px;
            text-align: center;
            background: transparent;
            border: none;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            color: var(--crema);
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
        }
        .cart-qty input:focus { outline: none; }
        .cart-remove-btn {
            background: transparent;
            border: none;
            color: var(--muted);
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            padding: 0;
            transition: color 0.2s;
        }
        .cart-remove-btn:hover { color: #e55; }
        /* ── Summary ── */
        .cart-summary {
            background: var(--verde-mid);
            border: 1px solid var(--border);
            padding: 2rem;
            position: sticky;
            top: 100px;
        }
        .cart-summary-title {
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: rgba(248,245,238,0.7);
            margin-bottom: 0.75rem;
        }
        .cart-summary-total {
            display: flex;
            justify-content: space-between;
            font-family: 'Space Mono', monospace;
            color: var(--crema);
            font-size: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
        }
        .btn-checkout {
            display: block;
            width: 100%;
            background: var(--dorado);
            color: var(--verde);
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border: none;
            padding: 0.9rem;
            cursor: pointer;
            transition: opacity 0.2s;
            text-align: center;
            text-decoration: none;
            margin-top: 1.5rem;
        }
        .btn-checkout:hover { opacity: 0.88; color: var(--verde); }
        .cart-empty {
            text-align: center;
            padding: 5rem 2rem;
        }
    </style>
@endpush

@section('content')

    <section class="cart-page px-4 px-md-5">

        @if(session('success'))
            <div class="py-2 px-4 mb-4" style="background: rgba(201,168,76,0.12); color: var(--dorado); font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.08em;">
                ✦ {{ session('success') }}
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between mb-5 pb-4 border-bottom" style="border-color: var(--border) !important;">
            <div>
                <p class="section-label mb-1">— Tu selección</p>
                <h1 class="cart-page-title">Mi Carrito</h1>
            </div>
            @if($products->count())
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="cart-remove-btn" style="font-size: 0.62rem;">✕ Vaciar carrito</button>
                </form>
            @endif
        </div>

        @if($products->isEmpty())
            <div class="cart-empty">
                <svg width="64" height="64" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24" class="mx-auto mb-4 d-block" style="color: rgba(201,168,76,0.3);">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <p class="mb-3" style="color: rgba(248,245,238,0.5); font-family: 'DM Sans', sans-serif;">Tu carrito está vacío.</p>
                <a href="{{ route('catalog') }}" style="color: var(--dorado); font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; text-decoration: none;">
                    Ver catálogo →
                </a>
            </div>
        @else
            <div class="row g-5">

                {{-- Items --}}
                <div class="col-12 col-lg-8">
                    @foreach($products as $item)
                        <div class="cart-item" data-cart-item="{{ $loop->index }}">
                            {{-- Imagen --}}
                            <img
                                src=""
                                data-cart-img="{{ $item['img_idx'] }}"
                                class="cart-item-img"
                                alt="{{ $item['product']->name }}"
                            >
                            {{-- Info --}}
                            <div class="flex-grow-1">
                                <p class="cart-item-name mb-1">{{ $item['product']->name }}</p>
                                <p class="cart-item-price mb-1">${{ number_format($item['product']->price, 2) }} MXN</p>
                                <p class="mb-3" style="font-size: 0.8rem; color: var(--muted); font-family: 'DM Sans', sans-serif;">{{ Str::limit($item['product']->description, 60) }}</p>

                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    {{-- Cantidad --}}
                                    <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <div class="cart-qty">
                                            <button type="button" class="qty-minus">−</button>
                                            <input type="number" name="quantity" class="qty-val" value="{{ $item['quantity'] }}" min="1" max="99" readonly>
                                            <button type="button" class="qty-plus">+</button>
                                        </div>
                                        <button type="submit" style="background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.08em; padding: 0.3rem 0.7rem; cursor: pointer; text-transform: uppercase; transition: color 0.2s;">Actualizar</button>
                                    </form>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cart-remove-btn">✕ Eliminar</button>
                                    </form>
                                </div>
                            </div>
                            {{-- Subtotal --}}
                            <div class="text-end">
                                <p class="cart-item-price">${{ number_format($item['subtotal'], 2) }}</p>
                                <p style="font-size: 0.62rem; color: var(--muted); font-family: 'Space Mono', monospace;">{{ $item['quantity'] }} × ${{ number_format($item['product']->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <a href="{{ route('catalog') }}" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; text-decoration: none;">
                            ← Seguir comprando
                        </a>
                    </div>
                </div>

                {{-- Resumen --}}
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <p class="cart-summary-title">Resumen del pedido</p>

                        @foreach($products as $item)
                            <div class="cart-summary-row">
                                <span>{{ Str::limit($item['product']->name, 22) }} ×{{ $item['quantity'] }}</span>
                                <span>${{ number_format($item['subtotal'], 2) }}</span>
                            </div>
                        @endforeach

                        <div class="cart-summary-row mt-3">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="cart-summary-row">
                            <span>Envío</span>
                            <span style="color: var(--dorado);">Gratis</span>
                        </div>
                        <div class="cart-summary-total">
                            <span>Total</span>
                            <span style="color: var(--dorado);">${{ number_format($total, 2) }} MXN</span>
                        </div>

                        <a href="/venta" class="btn-checkout">
                            Proceder al pago →
                        </a>

                        <p class="text-center mt-3" style="font-family: 'Space Mono', monospace; font-size: 0.58rem; letter-spacing: 0.1em; color: var(--muted); text-transform: uppercase;">
                            ✦ Pago seguro SSL · Envío express CDMX
                        </p>
                    </div>
                </div>

            </div>
        @endif
    </section>

@endsection

@push('scripts')
<script>
    // Controles de cantidad en el carrito
    document.querySelectorAll('.cart-qty').forEach(ctrl => {
        const input = ctrl.querySelector('.qty-val');
        ctrl.querySelector('.qty-minus').addEventListener('click', () => {
            if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
        });
        ctrl.querySelector('.qty-plus').addEventListener('click', () => {
            if (parseInt(input.value) < 99) input.value = parseInt(input.value) + 1;
        });
    });

    // Cargar imágenes desde DummyJSON
    (async () => {
        try {
            const [shirts, dresses, tops] = await Promise.all([
                fetch('https://dummyjson.com/products/category/mens-shirts?select=thumbnail').then(r => r.json()),
                fetch('https://dummyjson.com/products/category/womens-dresses?select=thumbnail').then(r => r.json()),
                fetch('https://dummyjson.com/products/category/tops?select=thumbnail').then(r => r.json()),
            ]);
            const clothingImgs = [
                ...shirts.products,
                ...dresses.products,
                ...tops.products,
            ].map(p => p.thumbnail);

            document.querySelectorAll('[data-cart-img]').forEach(img => {
                const idx = parseInt(img.getAttribute('data-cart-img')) % clothingImgs.length;
                img.src = clothingImgs[idx];
            });
        } catch (e) {
            document.querySelectorAll('[data-cart-img]').forEach(img => {
                img.src = 'https://via.placeholder.com/100x130/0d120e/c9a84c?text=FCA';
            });
        }
    })();
</script>
@endpush
