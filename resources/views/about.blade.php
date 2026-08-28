@extends('layouts.app')

@section('title', 'Sobre nosotros')

@section('content')
    <header class="about-hero d-flex align-items-end px-4 px-md-5 pt-5 pb-5">
        <div class="container-fluid p-0">
            <p class="section-label mb-3">— Sobre nosotros</p>
            <h1 class="hero-title about-hero-title text-white lh-1 mb-0">
                Vestimos<br><em>nuestra identidad.</em>
            </h1>
        </div>
    </header>

    <section class="about-intro py-5 px-4 px-md-5">
        <div class="container-fluid p-0">
            <div class="row g-5 align-items-center py-md-5">
                <div class="col-12 col-lg-5">
                    <p class="section-label mb-2">— Nuestra historia</p>
                    <h2 class="section-title mb-0">Más que una<br>prenda, comunidad.</h2>
                </div>
                <div class="col-12 col-lg-6 offset-lg-1">
                    <p class="fs-5 lh-lg mb-4" style="color: var(--crema);">
                        Tienda FCA nace en las aulas de la Facultad de Contaduría y Administración de la UNAM
                        para convertir el orgullo universitario en prendas que acompañen cada etapa de nuestra historia.
                    </p>
                    <p class="lh-lg mb-0" style="color: var(--muted);">
                        Diseñamos piezas atemporales, cómodas y de calidad premium para estudiantes, docentes,
                        egresados y toda la comunidad FCA. Cada colección celebra lo que nos une: la pasión por
                        aprender, crecer y dejar huella.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 px-4 px-md-5">
        <div class="container-fluid p-0">
            <div class="row g-1" style="background: var(--border);">
                <div class="col-12 col-md-4">
                    <article class="about-value h-100 p-4 p-md-5" data-animate>
                        <div class="about-value-number mb-5">01 / CALIDAD</div>
                        <h3 class="section-title fs-2 mb-3">Hecho para durar</h3>
                        <p class="mb-0 lh-lg" style="color: var(--muted);">
                            Elegimos materiales y acabados que resisten el ritmo de la vida universitaria.
                        </p>
                    </article>
                </div>
                <div class="col-12 col-md-4">
                    <article class="about-value h-100 p-4 p-md-5" data-animate>
                        <div class="about-value-number mb-5">02 / IDENTIDAD</div>
                        <h3 class="section-title fs-2 mb-3">Orgullo que se lleva</h3>
                        <p class="mb-0 lh-lg" style="color: var(--muted);">
                            Creamos diseños que hablan de nuestra facultad y de las personas que la hacen única.
                        </p>
                    </article>
                </div>
                <div class="col-12 col-md-4">
                    <article class="about-value h-100 p-4 p-md-5" data-animate>
                        <div class="about-value-number mb-5">03 / COMUNIDAD</div>
                        <h3 class="section-title fs-2 mb-3">Siempre cerca</h3>
                        <p class="mb-0 lh-lg" style="color: var(--muted);">
                            Somos un proyecto hecho por y para la comunidad FCA, con atención en cada detalle.
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 px-4 px-md-5">
        <div class="container-fluid p-0">
            <div class="row g-5 align-items-center py-md-5">
                <div class="col-12 col-lg-7">
                    <p class="about-quote ps-4 mb-0">
                        “La excelencia no solo se aprende: también se representa.”
                    </p>
                </div>
                <div class="col-12 col-lg-5">
                    <p class="section-label mb-2">— Forma parte</p>
                    <h2 class="section-title fs-1 mb-4">Lleva contigo<br>el espíritu FCA.</h2>
                    <a href="{{ route('catalog') }}" class="btn-primary-fca">Explorar catálogo</a>
                </div>
            </div>
        </div>
    </section>
@endsection
