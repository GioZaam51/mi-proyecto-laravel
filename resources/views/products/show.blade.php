@extends('layouts.app')

@section('title', $product->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link rel="stylesheet" href="{{ asset("css/product-show.css") }}">
@endpush

@section('content')

    <section class="show-hero px-4 px-md-5">

        @if(session('success'))
            <div class="show-alert alert py-2 px-4 mb-0">
                ❖ {{ session('success') }}
            </div>
        @endif

        {{-- Breadcrumb --}}
        <div class="breadcrumb-fca pt-2 pb-4">
            <a href="/">Inicio</a> &nbsp;/&nbsp;
            <a href="{{ route('catalog') }}">Catálogo</a> &nbsp;/&nbsp;
            <span>{{ $product->name }}</span>
        </div>

        <div class="row g-5 align-items-start pb-5">

            {{-- Imagen --}}
            <div class="col-12 col-md-6" data-animate>
                <div id="imgSkeleton" class="product-show-img-skeleton"></div>
                <img
                    id="productShowImg"
                    src=""
                    alt="{{ $product->name }}"
                    class="product-show-img d-none"
                    data-show-img="{{ ($product->id - 1) % 30 }}"
                >
            </div>

            {{-- Info --}}
            <div class="col-12 col-md-6" data-animate>
                <p class="product-show-tag">✦ FCA Collection</p>
                <h1 class="product-show-title">{{ $product->name }}</h1>
                <div class="product-show-price">${{ number_format($product->price, 2) }} <span class="product-show-price-currency">MXN</span></div>
                <p class="product-show-tax">IVA incluido</p>

                <p class="product-show-desc">{{ $product->description }}</p>

                {{-- Formulario agregar al carrito --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="img_idx" id="imgIdxInput" value="{{ ($product->id - 1) % 30 }}">

                    <p class="qty-label mb-2">Cantidad</p>
                    <div class="d-flex align-items-center flex-wrap gap-3 mb-4">
                        <div class="quantity-control">
                            <button type="button" id="qtyMinus">−</button>
                            <input type="number" name="quantity" id="qtyInput" value="1" min="1" max="99" readonly>
                            <button type="button" id="qtyPlus">+</button>
                        </div>
                        <button type="submit" class="btn-add-cart">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                                <line x1="3" y1="6" x2="21" y2="6"/>
                                <path d="M16 10a4 4 0 01-8 0"/>
                            </svg>
                            Agregar al carrito
                        </button>
                    </div>
                </form>

                {{-- Meta info --}}
                <div class="product-meta-row">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    Envío express CDMX · 24 hrs
                </div>
                <div class="product-meta-row">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    Pago seguro SSL · Efectivo, tarjeta y transferencia
                </div>
                <div class="product-meta-row">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Calidad premium · Telas seleccionadas FCA
                </div>

                <div class="mt-4">
                    <a href="{{ route('catalog') }}" class="show-back-link">
                        ← Volver al catálogo
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Controles de cantidad
    const qtyInput = document.getElementById('qtyInput');
    document.getElementById('qtyMinus').addEventListener('click', () => {
        if (parseInt(qtyInput.value) > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
    });
    document.getElementById('qtyPlus').addEventListener('click', () => {
        if (parseInt(qtyInput.value) < 99) qtyInput.value = parseInt(qtyInput.value) + 1;
    });

    // Cargar imagen desde DummyJSON
    (async () => {
        try {
            const idx = parseInt(document.getElementById('productShowImg').dataset.showImg) || 0;
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

            const realIdx = idx % clothingImgs.length;
            const imgEl = document.getElementById('productShowImg');
            imgEl.onload = () => {
                document.getElementById('imgSkeleton').style.display = 'none';
                imgEl.classList.remove('d-none');
            };
            imgEl.src = clothingImgs[realIdx];
            document.getElementById('imgIdxInput').value = realIdx;
        } catch (e) {
            document.getElementById('imgSkeleton').style.display = 'none';
            const imgEl = document.getElementById('productShowImg');
            imgEl.src = 'https://via.placeholder.com/600x700/0d120e/c9a84c?text=FCA';
            imgEl.classList.remove('d-none');
        }
    })();
</script>
@endpush
