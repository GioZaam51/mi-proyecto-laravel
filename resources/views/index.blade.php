@extends('layouts.app')

@section('title', 'Inicio')

@push('styles')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
@endpush

@section('content')

    {{-- ═══ HERO ═══ --}}
    <header class="hero">
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
        <p class="hero-sub">Moda de calidad premium para la comunidad FCA. Prendas que representan tu identidad y compromiso con la excelencia académica.</p>
        <div class="hero-actions">
            <a href="#productos" class="btn-primary-fca">Ver catálogo</a>
            <a href="/venta" class="btn-ghost-fca">Realizar venta</a>
        </div>
        <div class="hero-scroll">
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
    <section class="features-section" aria-label="Beneficios">
        <div class="feature-item" data-animate>
            <div class="feature-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </div>
            <h3 class="feature-title">Envío Express</h3>
            <p class="feature-text">Entrega en 24 horas a toda la Ciudad de México. Rastreo en tiempo real desde el momento de tu compra.</p>
        </div>
        <div class="feature-item" data-animate>
            <div class="feature-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="feature-title">Calidad Premium</h3>
            <p class="feature-text">Telas 100% seleccionadas, costuras reforzadas y acabados que resisten el paso del tiempo y el uso diario.</p>
        </div>
        <div class="feature-item" data-animate>
            <div class="feature-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            </div>
            <h3 class="feature-title">Pago Seguro</h3>
            <p class="feature-text">Transacciones protegidas con cifrado SSL de 256 bits. Aceptamos efectivo, tarjeta y transferencia bancaria.</p>
        </div>
    </section>

    {{-- ═══ PRODUCTS ═══ --}}
    <section class="products-section" id="productos">
        <div class="products-header">
            <div>
                <p class="section-label">— Catálogo Oficial</p>
                <h2 class="section-title">Nuestros<br>Productos</h2>
                <p class="product-count">{{ $products->count() }} {{ $products->count() === 1 ? 'artículo disponible' : 'artículos disponibles' }}</p>
            </div>
            <a href="/venta" class="btn-ghost-fca">Realizar venta →</a>
        </div>

        <div class="product-grid">
            @forelse($products as $product)
                <div class="product-card" data-animate>
                    <div class="product-img-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=800&auto=format&fit=crop"
                            class="product-img"
                            alt="{{ $product->name }}"
                            loading="lazy"
                        >
                        <div class="product-overlay">
                            <a href="/venta">Comprar ahora</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <p class="product-badge">FCA Collection ✦</p>
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-desc">{{ Str::limit($product->description, 55) }}</p>
                        <div class="product-footer">
                            <div class="product-price">${{ number_format($product->price, 2) }}</div>
                            <div class="product-buy-icon">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="product-empty">
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1.25rem;display:block;color:rgba(201,168,76,0.4)"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
                    <p>Aún no hay productos registrados.</p>
                    <a href="/admin/productos">Registra el primero aquí →</a>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ═══ BANNER ═══ --}}
    <section class="banner-split" id="nosotros">
        <div class="banner-img"></div>
        <div class="banner-content">
            <p class="section-label">— Nuestra Historia</p>
            <h2 class="section-title">Moda con<br>Identidad FCA</h2>
            <p>Nacimos en las aulas de la Facultad de Contaduría y Administración de la UNAM. Cada prenda lleva el orgullo de nuestra comunidad: rigor académico, estilo propio y calidad sin concesiones.</p>
            <a href="/nosotros" class="btn-primary-fca">Conoce más</a>
        </div>
    </section>

    {{-- ═══ TESTIMONIALS ═══ --}}
    <section class="testimonials-section">
        <div class="testimonials-header">
            <p class="section-label">— Reseñas</p>
            <h2 class="section-title">Lo Que Dice<br>Nuestra Comunidad</h2>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card" data-animate>
                <div class="stars">★★★★★</div>
                <p class="testimonial-text">"La calidad de la sudadera superó mis expectativas. El material es grueso, bien cosido y el diseño representa perfectamente a la FCA."</p>
                <div class="testimonial-divider"></div>
                <div class="testimonial-author">
                    <strong>Karla Mendoza</strong>
                    <span>Licenciatura en Contaduría</span>
                </div>
            </div>
            <div class="testimonial-card" data-animate>
                <div class="stars">★★★★★</div>
                <p class="testimonial-text">"Llegó en menos de 24 horas y el empaque estaba muy cuidado. Sin duda volvería a comprar. Excelente proyecto universitario."</p>
                <div class="testimonial-divider"></div>
                <div class="testimonial-author">
                    <strong>Diego Ramírez</strong>
                    <span>Licenciatura en Administración</span>
                </div>
            </div>
            <div class="testimonial-card" data-animate>
                <div class="stars">★★★★☆</div>
                <p class="testimonial-text">"Ropa que realmente se ve diferente. Con el logo de la FCA se ve mucho más elegante de lo que esperaba. Muy buena iniciativa."</p>
                <div class="testimonial-divider"></div>
                <div class="testimonial-author">
                    <strong>Sofía Torres</strong>
                    <span>Licenciatura en Informática</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ NEWSLETTER ═══ --}}
    <section class="newsletter-section">
        <div class="newsletter-text">
            <p class="section-label">— Mantente al día</p>
            <h2 class="section-title">Nuevos Drops,<br>Primero Tú</h2>
            <p>Suscríbete y recibe notificaciones de nuevas colecciones, descuentos exclusivos para la comunidad FCA y preventas anticipadas.</p>
        </div>
        <div class="newsletter-form-wrap">
            <form class="newsletter-form" onsubmit="return false;">
                <input type="email" placeholder="tu@correo.unam.mx" autocomplete="email">
                <button type="submit">Suscribirse</button>
            </form>
            <p class="newsletter-note">✦ Sin spam · Solo novedades FCA</p>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    window.addEventListener('load', () => {
        document.getElementById('heroBadge')?.classList.add('visible');
    });
</script>
@endpush