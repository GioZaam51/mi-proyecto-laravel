@extends('layouts.app')

@section('title', 'Inicio')

@push('styles')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
@endpush

@section('content')

    {{-- ═══ HERO ═══ --}}
    <header class="hero d-flex flex-column justify-content-end p-4 p-md-5 overflow-hidden position-relative">
        <div class="hero-bg"></div>

        <div class="hero-badge" id="heroBadge">
            <svg viewBox="0 0 130 130" width="130" height="130">
                <path id="circlePath" d="M65,65 m-50,0 a50,50 0 1,1 100,0 a50,50 0 1,1 -100,0" fill="none"/>
                <text font-family="Space Mono, monospace" font-size="9.5" letter-spacing="4.5" fill="rgba(201,168,76,0.7)">
                    <textPath href="#circlePath">TIENDA FCA · UNAM · MODA UNIVERSITARIA · </textPath>
                </text>
            </svg>
            <div class="hero-badge-center">2026<span>Colección</span></div>
        </div>

        <p class="hero-tag">Nueva Colección 2026</p>
        <h1 class="hero-title">
            Viste con<br><em>Orgullo</em><br>Universitario
        </h1>
        <p class="hero-sub text-white-50 mt-4 fs-6 lh-lg">Moda de calidad premium para la comunidad FCA. Prendas que representan tu identidad y compromiso con la excelencia académica.</p>
        <div class="hero-actions d-flex flex-wrap gap-3 mt-5">
            <a href="{{ route('catalog') }}" class="btn-primary-fca">Ver catálogo</a>
        </div>
        <div class="hero-scroll d-none d-md-flex">
            <div class="hero-scroll-line"></div>
            Descubrir
        </div>
    </header>

    {{-- ═══ MARQUEE ═══ --}}
    <div class="marquee-wrap" aria-hidden="true">
        <div class="marquee-inner">
            @for ($i = 0; $i < 2; $i++)
                <span>Tienda FCA</span><span class="sep">✦</span>
                <span>Nueva Colección 2026</span><span class="sep">✦</span>
                <span>UNAM · FCA</span><span class="sep">✦</span>
                <span>Envío Express CDMX</span><span class="sep">✦</span>
                <span>Calidad Premium</span><span class="sep">✦</span>
                <span>Pago Seguro SSL</span><span class="sep">✦</span>
                <span>Edición Limitada</span><span class="sep">✦</span>
            @endfor
        </div>
    </div>

    {{-- ═══ FEATURES ═══ --}}
    <section class="container-fluid px-0 border-top border-start" style="border-color: var(--border) !important;" aria-label="Beneficios">
        <div class="row g-0">
            <div class="col-12 col-md-4">
                <div class="feature-item p-4 p-md-5 border-end border-bottom h-100" data-animate style="border-color: var(--border) !important; transition: background 0.3s; background: var(--verde);">
                    <div class="feature-icon d-flex align-items-center justify-content-center mb-4" style="width: 46px; height: 46px; border: 1px solid var(--border); background: var(--dorado-dim); color: var(--dorado);">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <h3 class="feature-title text-white text-uppercase" style="font-family: 'Space Mono', monospace; font-size: 0.78rem; letter-spacing: 0.1em; margin-bottom: 0.75rem;">Envío Express</h3>
                    <p class="feature-text uted mb-0" style="font-size: 0.875rem; line-height: 1.75;">Entrega en 24 horas a toda la Ciudad de México. Rastreo en tiempo real desde el momento de tu compra.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="feature-item p-4 p-md-5 border-end border-bottom h-100" data-animate style="border-color: var(--border) !important; transition: background 0.3s; background: var(--verde);">
                    <div class="feature-icon d-flex align-items-center justify-content-center mb-4" style="width: 46px; height: 46px; border: 1px solid var(--border); background: var(--dorado-dim); color: var(--dorado);">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="feature-title text-white text-uppercase" style="font-family: 'Space Mono', monospace; font-size: 0.78rem; letter-spacing: 0.1em; margin-bottom: 0.75rem;">Calidad Premium</h3>
                    <p class="feature-text uted mb-0" style="font-size: 0.875rem; line-height: 1.75;">Telas 100% seleccionadas, costuras reforzadas y acabados que resisten el paso del tiempo y el uso diario.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="feature-item p-4 p-md-5 border-end border-bottom h-100" data-animate style="border-color: var(--border) !important; transition: background 0.3s; background: var(--verde);">
                    <div class="feature-icon d-flex align-items-center justify-content-center mb-4" style="width: 46px; height: 46px; border: 1px solid var(--border); background: var(--dorado-dim); color: var(--dorado);">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    </div>
                    <h3 class="feature-title text-white text-uppercase" style="font-family: 'Space Mono', monospace; font-size: 0.78rem; letter-spacing: 0.1em; margin-bottom: 0.75rem;">Pago Seguro</h3>
                    <p class="feature-text uted mb-0" style="font-size: 0.875rem; line-height: 1.75;">Transacciones protegidas con cifrado SSL de 256 bits. Aceptamos efectivo, tarjeta y transferencia bancaria.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ PRODUCTS ═══ --}}
    <section class="py-5 px-4 px-md-5" id="productos">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 pb-4 border-bottom" style="border-color: var(--border) !important;">
            <div>
                <p class="section-label mb-2">— Catálogo Oficial</p>
                <h2 class="section-title m-0">Nuestros<br>Productos</h2>
                <p class="product-count mt-3 mb-0" style="font-family: 'Space Mono', monospace; font-size: 0.7rem; letter-spacing: 0.15em; color: var(--muted);">{{ $products->count() }} {{ $products->count() === 1 ? 'artículo disponible' : 'artículos disponibles' }}</p>
            </div>
            <div class="mt-4 mt-md-0">
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
                        <div class="p-4">
                            <p class="product-badge">FCA Collection ✦</p>
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-desc">{{ Str::limit($product->description, 55) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
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
                        <p class="uted mb-3">Aún no hay productos registrados.</p>
                        <a href="/admin/productos" style="color: var(--dorado); text-decoration: none;">Registra el primero aquí →</a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ═══ BANNER ═══ --}}
    <section class="row g-0 border-top border-bottom" style="border-color: var(--border) !important;" id="nosotros">
        <div class="col-12 col-md-6 banner-img" style="min-height: 480px;"></div>
        <div class="col-12 col-md-6 bg-dark p-5 d-flex flex-column justify-content-center border-start text-white" style="border-color: var(--border) !important;">
            <p class="section-label mb-2">— Nuestra Historia</p>
            <h2 class="section-title mb-4">Moda con<br>Identidad FCA</h2>
            <p class="text-white-50 lh-lg mb-5" style="max-width: 380px;">Nacimos en las aulas de la Facultad de Contaduría y Administración de la UNAM. Cada prenda lleva el orgullo de nuestra comunidad: rigor académico, estilo propio y calidad sin concesiones.</p>
            <div class="align-self-start">
                <a href="/nosotros" class="btn-primary-fca">Conoce más</a>
            </div>
        </div>
    </section>

    {{-- ═══ TESTIMONIALS ═══ --}}
    <section class="py-5 px-4 px-md-5">
        <div class="text-center mb-5 pb-3">
            <p class="section-label mb-2">— Reseñas</p>
            <h2 class="section-title m-0">Lo Que Dice<br>Nuestra Comunidad</h2>
        </div>
        <div class="row g-1" style="background: var(--border);">
            <div class="col-12 col-md-4">
                <div class="testimonial-card p-4 p-md-5 h-100" data-animate style="background: var(--verde-mid); transition: background 0.3s;">
                    <div class="stars mb-3" style="color: var(--dorado); font-size: 0.85rem; letter-spacing: 0.1em;">★★★★★</div>
                    <p class="testimonial-text" style="color: rgba(248, 245, 238, 0.75); font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 1.05rem; line-height: 1.7;">"La calidad de la sudadera superó mis expectativas. El material es grueso, bien cosido y el diseño representa perfectamente a la FCA."</p>
                    <div class="testimonial-divider my-4" style="width: 30px; height: 1px; background: var(--border);"></div>
                    <div class="testimonial-author text-uppercase" style="font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.15em;">
                        <strong class="text-white d-block mb-1">Karla Mendoza</strong>
                        <span class="uted">Licenciatura en Contaduría</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="testimonial-card p-4 p-md-5 h-100" data-animate style="background: var(--verde-mid); transition: background 0.3s;">
                    <div class="stars mb-3" style="color: var(--dorado); font-size: 0.85rem; letter-spacing: 0.1em;">★★★★★</div>
                    <p class="testimonial-text" style="color: rgba(248, 245, 238, 0.75); font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 1.05rem; line-height: 1.7;">"Llegó en menos de 24 horas y el empaque estaba muy cuidado. Sin duda volvería a comprar. Excelente proyecto universitario."</p>
                    <div class="testimonial-divider my-4" style="width: 30px; height: 1px; background: var(--border);"></div>
                    <div class="testimonial-author text-uppercase" style="font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.15em;">
                        <strong class="text-white d-block mb-1">Diego Ramírez</strong>
                        <span class="uted">Licenciatura en Administración</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="testimonial-card p-4 p-md-5 h-100" data-animate style="background: var(--verde-mid); transition: background 0.3s;">
                    <div class="stars mb-3" style="color: var(--dorado); font-size: 0.85rem; letter-spacing: 0.1em;">★★★★☆</div>
                    <p class="testimonial-text" style="color: rgba(248, 245, 238, 0.75); font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 1.05rem; line-height: 1.7;">"Ropa que realmente se ve diferente. Con el logo de la FCA se ve mucho más elegante de lo que esperaba. Muy buena iniciativa."</p>
                    <div class="testimonial-divider my-4" style="width: 30px; height: 1px; background: var(--border);"></div>
                    <div class="testimolnial-author text-uppercase" style="font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.15em;">
                        <strong class="text-white d-block mb-1">Sofía Torres</strong>
                        <span class="uted">Licenciatura en Informática</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ NEWSLETTER ═══ --}}
    <section class="bg-dark py-5 px-4 px-md-5 d-flex flex-column flex-md-row align-items-center justify-content-between border-top border-bottom gap-4 gap-md-5" style="border-color: var(--border) !important;">
        <div class="flex-grow-1">
            <p class="section-label mb-2">— Mantente al día</p>
            <h2 class="section-title fs-1 m-0">Nuevos Drops,<br>Primero Tú</h2>
            <p class="uted mt-3 mb-0" style="max-width: 400px;">Suscríbete y recibe notificaciones de nuevas colecciones, descuentos exclusivos para la comunidad FCA y preventas anticipadas.</p>
        </div>
        <div class="flex-grow-1 w-100" style="max-width: 480px;">
            <form class="d-flex w-100 mb-3" onsubmit="return false;">
                <input type="email" class="form-control rounded-0 text-white border-end-0 p-3" style="background: rgba(248, 245, 238, 0.05); border-color: var(--border) !important; font-family: 'DM Sans', sans-serif;" placeholder="tu@correo.unam.mx" autocomplete="email">
                <button type="submit" class="btn rounded-0 px-4 fw-bold text-uppercase" style="background: var(--dorado); color: var(--verde); font-family: 'Space Mono', monospace; font-size: 0.72rem; letter-spacing: 0.1em; transition: opacity 0.2s;">Suscribirse</button>
            </form>
            <p class="uted text-uppercase m-0" style="font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.12em;">✦ Sin spam · Solo novedades FCA</p>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    window.addEventListener('load', () => {
        document.getElementById('heroBadge')?.classList.add('visible');
    });

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