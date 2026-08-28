@extends('layouts.app')

@section('title', 'Sobre nosotros')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <header class="about-hero">
        <div class="about-hero-content">
            <p class="section-label mb-3">— Sobre nosotros</p>
            <h1 class="about-title">Vestimos la<br><em>identidad</em> FCA</h1>
            <p class="about-lead">Una colección creada para celebrar lo que somos, lo que aprendemos y la comunidad que construimos dentro y fuera de las aulas.</p>
        </div>
        <div class="about-hero-mark" aria-hidden="true">FCA<br><span>UNAM</span></div>
    </header>

    <main class="about-page">
        <section class="about-intro container-fluid px-4 px-md-5">
            <div class="row g-5 align-items-start">
                <div class="col-12 col-md-5" data-animate>
                    <p class="section-label">— Nuestra historia</p>
                    <h2 class="section-title">Más que<br>una prenda.</h2>
                </div>
                <div class="col-12 col-md-7 about-copy" data-animate>
                    <p class="about-kicker">Tienda FCA nació en la Facultad de Contaduría y Administración de la UNAM con una idea sencilla: llevar el orgullo universitario a cada espacio de nuestra vida.</p>
                    <p>Diseñamos prendas contemporáneas que hablan de nuestra comunidad sin perder de vista lo más importante: materiales que se sienten bien, acabados cuidados y piezas hechas para acompañarte todos los días.</p>
                    <p>Somos estudiantes, docentes y personas que creen en los proyectos con propósito. Cada compra apoya una iniciativa universitaria y mantiene viva una identidad que compartimos.</p>
                </div>
            </div>
        </section>

        <section class="about-values border-top border-bottom" aria-label="Nuestros valores">
            <div class="container-fluid px-4 px-md-5">
                <div class="row g-0">
                    <div class="col-12 col-md-4 about-value" data-animate>
                        <span class="about-number">01</span>
                        <h3>Identidad</h3>
                        <p>Diseños que representan la energía, el carácter y la diversidad de la FCA.</p>
                    </div>
                    <div class="col-12 col-md-4 about-value" data-animate>
                        <span class="about-number">02</span>
                        <h3>Calidad</h3>
                        <p>Elegimos materiales y procesos que hacen que cada pieza dure más.</p>
                    </div>
                    <div class="col-12 col-md-4 about-value" data-animate>
                        <span class="about-number">03</span>
                        <h3>Comunidad</h3>
                        <p>Un proyecto hecho por y para quienes forman parte de la vida universitaria.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-cta container-fluid px-4 px-md-5">
            <div class="about-cta-inner" data-animate>
                <p class="section-label mb-3">— Forma parte</p>
                <h2 class="section-title">Tu historia también<br><em>lleva nuestros colores.</em></h2>
                <a href="{{ route('catalog') }}" class="btn-primary-fca mt-4">Explorar catálogo</a>
            </div>
        </section>
    </main>
@endsection
