@extends('layouts.app')

@section('title', 'Catálogo')

@push('styles')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
@endpush

@section('content')

    {{-- HEADER CATEGORY --}}
    <div class="py-5 px-4 px-md-5 d-flex align-items-center justify-content-center position-relative" style="min-height: 45vh; background: var(--verde) url('https://loremflickr.com/1920/1080/fashion?random=200') center/cover no-repeat; border-bottom: 1px solid var(--border);">
        <div class="position-absolute w-100 h-100 top-0 start-0" style="background: rgba(13, 18, 14, 0.7); z-index: 1;"></div>
        <div class="position-relative text-center" style="z-index: 2;">
            <p class="section-label text-white mb-2" style="opacity: 0; animation: fadeUp 0.8s 0.2s forwards;">— Toda la colección</p>
            <h1 class="hero-title text-white lh-1 m-0" style="font-size: 3.5rem; opacity: 0; animation: fadeUp 0.8s 0.4s forwards;">
                Catálogo<br>Oficial FCA
            </h1>
        </div>
    </div>

    {{-- ═══ PRODUCTS ═══ --}}
    <section class="py-5 px-4 px-md-5" id="productos" style="background: var(--verde);">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 pb-4 border-bottom" style="border-color: var(--border) !important;">
            <div>
                <h2 class="section-title m-0">Todos los<br>Productos</h2>
                <p class="product-count mt-3 mb-0" style="font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.15em; color: var(--muted);">{{ $products->count() }} {{ $products->count() === 1 ? 'artículo disponible' : 'artículos disponibles' }}</p>
            </div>
            <div class="mt-4 mt-md-0 d-flex gap-3">
                <a href="/venta" class="btn-ghost-fca">Realizar venta →</a>
            </div>
        </div>

        <div class="row g-1" style="background: var(--border);">
            @forelse($products as $product)
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('products.show', $product->id) }}?img_idx={{ $loop->index }}" class="text-decoration-none d-block h-100">
                    <div class="product-card h-100 position-relative border-0" data-animate style="background: var(--verde-mid); overflow: hidden; cursor: pointer;">
                        <div class="product-img-wrap" style="aspect-ratio: 3/4; overflow: hidden;">
                            <img
                                src=""
                                data-product-img="{{ $loop->index }}"
                                class="product-img w-100 h-100 object-fit-cover"
                                alt="{{ $product->name }}"
                                loading="lazy"
                                style="background: rgba(201,168,76,0.07); object-fit: cover;"
                            >
                            <div class="product-overlay">
                                <span>Ver producto</span>
                            </div>
                        </div>
                        <div class="p-4 flex-grow-1 d-flex flex-column">
                            <p class="product-badge">FCA Collection ✦</p>
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-desc mb-4" style="color: var(--muted);">{{ Str::limit($product->description, 55) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div class="product-price">${{ number_format($product->price, 2) }}</div>
                                <div class="product-buy-icon d-flex justify-content-center align-items-center" style="width: 32px; height: 32px; border: 1px solid var(--border); color: var(--muted); transition: border-color 0.2s, color 0.2s;">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-5 text-center" style="background: var(--verde-mid);">
                        <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="mx-auto mb-4 d-block" style="color:rgba(201,168,76,0.4)"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
                        <p class="text-white-50 mb-3">Aún no hay productos registrados.</p>
                        <a href="/admin/productos" style="color: var(--dorado); text-decoration: none;">Registra el primero aquí →</a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Cargar imágenes desde DummyJSON API (ropa)
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
            document.querySelectorAll('[data-product-img]').forEach(img => {
                const idx = parseInt(img.getAttribute('data-product-img')) % clothingImgs.length;
                img.src = clothingImgs[idx];
                img.style.objectFit = 'cover';
            });
        } catch (e) {
            document.querySelectorAll('[data-product-img]').forEach(img => {
                img.src = 'https://via.placeholder.com/400x600/0d120e/c9a84c?text=FCA';
            });
        }
    })();
</script>
@endpush
