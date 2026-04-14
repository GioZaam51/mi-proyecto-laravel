@extends('layouts.app')

@section('title', 'Mi Carrito')

@push('styles')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link rel="stylesheet" href="{{ asset("css/cart.css") }}">
@endpush

@section('content')

    <section class="cart-page px-4 px-md-5">

        @if(session('success'))
            <div class="cart-success-notice">
                ❖ {{ session('success') }}
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
                <svg width="64" height="64" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24" class="cart-empty-icon mx-auto mb-4 d-block">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <p class="cart-empty-text mb-3">Tu carrito está vacío.</p>
                <a href="{{ route('catalog') }}" class="cart-empty-link">
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
                                <p class="cart-item-desc">{{ Str::limit($item['product']->description, 60) }}</p>

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
                                        <button type="submit" class="cart-update-btn">Actualizar</button>
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
                                <p class="cart-item-meta">{{ $item['quantity'] }} × ${{ number_format($item['product']->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <a href="{{ route('catalog') }}" class="cart-continue-link">
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
                            <span class="cart-summary-shipping">Gratis</span>
                        </div>
                        <div class="cart-summary-total">
                            <span>Total</span>
                            <span class="cart-summary-total-amount">${{ number_format($total, 2) }} MXN</span>
                        </div>

                        <a href="{{ route('sales.create') }}" class="btn-checkout">
                            Proceder al pago →
                        </a>

                        <p class="cart-secure-notice">
                            ❖ Pago seguro SSL · Envío express CDMX
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
