<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tienda FCA — Moda universitaria de la Facultad de Contaduría y Administración, UNAM.">
    <title>@yield('title', 'Tienda FCA') | Facultad de Contaduría y Administración</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Global Styles -->
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">

    @stack('styles')
</head>
<body>

    <div class="cursor" id="cursor"></div>

    <!-- ═══════════ NAVBAR ═══════════ -->
    <nav id="navbar">
        <a href="/" class="nav-logo">
            <div class="nav-logo-icon">FCA</div>
            <div class="nav-logo-text">
                <span class="nav-logo-name">Tienda <span>FCA</span></span>
                <span class="nav-logo-sub">UNAM · Moda Universitaria</span>
            </div>
        </a>

        <button class="hamburger" id="hamburger" aria-label="Abrir menú">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="/#productos" class="{{ request()->is('productos*') ? 'active' : '' }}">Catálogo</a></li>
            <li><a href="/nosotros" class="{{ request()->is('nosotros') ? 'active' : '' }}">Nosotros</a></li>
            <li><a href="/contacto" class="{{ request()->is('contacto') ? 'active' : '' }}">Contacto</a></li>
            <li><a href="/venta" class="btn-nav-primary">Realizar Venta</a></li>
        </ul>
    </nav>

    <!-- ═══════════ CONTENIDO PRINCIPAL ═══════════ -->
    <main>
        @yield('content')
    </main>

    <!-- ═══════════ FOOTER ═══════════ -->
    <footer>
        <div class="footer-divider"></div>
        <div class="footer-top">
            <!-- Brand -->
            <div>
                <div class="footer-brand-name">Tienda <span>FCA</span></div>
                <div class="footer-brand-tag">✦ Facultad de Contaduría y Administración</div>
                <p class="footer-desc">Moda universitaria de calidad premium, diseñada para la comunidad de la Facultad de Contaduría y Administración de la UNAM.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Instagram">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" aria-label="Facebook">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" aria-label="Twitter / X">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.845L1.254 2.25H8.08l4.254 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" aria-label="TikTok">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.54V6.74a4.85 4.85 0 01-1.01-.05z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Col: Tienda -->
            <div class="footer-col">
                <h6>Tienda</h6>
                <ul>
                    <li><a href="/#productos">Catálogo</a></li>
                    <li><a href="#">Novedades</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Edición limitada</a></li>
                    <li><a href="/venta">Realizar venta</a></li>
                </ul>
            </div>

            <!-- Col: Ayuda -->
            <div class="footer-col">
                <h6>Ayuda</h6>
                <ul>
                    <li><a href="#">Envíos</a></li>
                    <li><a href="#">Devoluciones</a></li>
                    <li><a href="#">Guía de tallas</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                    <li><a href="#">Preguntas frecuentes</a></li>
                </ul>
            </div>

            <!-- Col: Institución -->
            <div class="footer-col">
                <h6>Institución</h6>
                <ul>
                    <li><a href="/nosotros">Acerca de</a></li>
                    <li><a href="#">FCA UNAM</a></li>
                    <li><a href="#">Implementación de Sistemas</a></li>
                    <li><a href="/admin/productos">Panel Admin</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                <p>© 2026 Tienda FCA · Facultad de Contaduría y Administración, UNAM</p>
                <p style="margin-top:0.25rem">Desarrollado por Giovanni · Implementación de Sistemas</p>
            </div>
            <ul class="footer-bottom-links">
                <li><a href="#">Privacidad</a></li>
                <li><a href="#">Términos</a></li>
                <li><a href="#">Cookies</a></li>
            </ul>
        </div>
    </footer>

    <!-- ═══════════ GLOBAL SCRIPTS ═══════════ -->
    <script>
        // Custom cursor
        const cursor = document.getElementById('cursor');
        document.addEventListener('mousemove', e => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top  = e.clientY + 'px';
        });
        document.querySelectorAll('a, button').forEach(el => {
            el.addEventListener('mouseenter', () => cursor.classList.add('expand'));
            el.addEventListener('mouseleave', () => cursor.classList.remove('expand'));
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });

        // Hamburger
        const hamburger = document.getElementById('hamburger');
        const navLinks   = document.getElementById('navLinks');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            navLinks.classList.toggle('open');
        });

        // Intersection Observer — fade in on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity    = '1';
                    entry.target.style.transform  = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        document.querySelectorAll('[data-animate]').forEach((el, i) => {
            el.style.opacity    = '0';
            el.style.transform  = 'translateY(24px)';
            el.style.transition = `opacity 0.55s ${i * 0.07}s, transform 0.55s ${i * 0.07}s`;
            observer.observe(el);
        });
    </script>

    @stack('scripts')
</body>
</html>