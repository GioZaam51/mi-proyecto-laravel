<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreetWear UNAM | Tienda Oficial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            color: white;
        }
        .product-card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">STREETWEAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#productos">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white ms-lg-3" href="/venta">Realizar Venta</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold">Nueva Colección 2026</h1>
            <p class="lead mb-4">Encuentra el estilo que define tu personalidad.</p>
            <a href="#productos" class="btn btn-light btn-lg px-5 shadow">Ver Catálogo</a>
        </div>
    </header>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="bi bi-truck fs-1 text-primary"></i>
                    <h4 class="mt-3">Envío Rápido</h4>
                    <p class="text-muted">A toda la Ciudad de México en 24h.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-shield-check fs-1 text-primary"></i>
                    <h4 class="mt-3">Calidad Premium</h4>
                    <p class="text-muted">Telas seleccionadas para mayor durabilidad.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-credit-card fs-1 text-primary"></i>
                    <h4 class="mt-3">Pago Seguro</h4>
                    <p class="text-muted">Transacciones protegidas con SSL.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="productos" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Nuestros Productos</h2>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 product-card border-0 shadow-sm">
                            <img src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1000&auto=format&fit=crop" class="card-img-top" alt="Ropa">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 50) }}</p>
                                <p class="fw-bold fs-5 text-primary">${{ number_format($product->price, 2) }}</p>
                                <a href="/venta" class="btn btn-outline-dark w-100">Comprar ahora</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Aún no hay productos registrados. <a href="/admin/productos">Registra el primero aquí.</a></p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2026 StreetWear UNAM. Proyecto para Implementación de Sistemas.</p>
            <small class="text-muted">Desarrollado por Giovanni - Facultad de Contaduría y Administración</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>