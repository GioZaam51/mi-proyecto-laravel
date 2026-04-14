@extends('layouts.app')

@section('title', 'Confirmar Pedido — FCA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        /* ── Checkout Page ── */
        .checkout-page {
            min-height: 100vh;
            padding-top: 110px;
            background: var(--verde);
        }
        .checkout-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            color: var(--crema);
            line-height: 1.1;
        }

        /* ── Table ── */
        .checkout-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
        }
        .checkout-table thead tr {
            border-bottom: 1px solid var(--border);
        }
        .checkout-table th {
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 0 1rem 0.75rem;
            font-weight: 400;
        }
        .checkout-table th:first-child { padding-left: 0; }
        .checkout-table th:last-child  { padding-right: 0; text-align: right; }
        .checkout-table td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--crema);
            vertical-align: middle;
        }
        .checkout-table td:first-child { padding-left: 0; }
        .checkout-table td:last-child  { padding-right: 0; text-align: right; }
        .checkout-product-img {
            width: 56px;
            height: 72px;
            object-fit: cover;
            border: 1px solid var(--border);
        }
        .checkout-product-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--crema);
        }
        .checkout-product-price {
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            color: var(--dorado);
        }

        /* ── Summary Panel ── */
        .checkout-summary {
            background: var(--verde-mid);
            border: 1px solid var(--border);
            padding: 2rem;
            position: sticky;
            top: 100px;
        }
        .checkout-summary-title {
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            color: rgba(248,245,238,0.7);
            margin-bottom: 0.65rem;
        }
        .summary-row.iva-row {
            color: rgba(201,168,76,0.7);
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-family: 'Space Mono', monospace;
            font-size: 1.05rem;
            color: var(--crema);
            padding-top: 1rem;
            margin-top: 0.5rem;
            border-top: 1px solid var(--border);
        }
        .summary-total span:last-child {
            color: var(--dorado);
        }

        /* ── Buyer Input ── */
        .fca-label {
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            display: block;
            margin-bottom: 0.4rem;
        }
        .fca-input {
            width: 100%;
            background: rgba(248,245,238,0.04);
            border: 1px solid var(--border);
            color: var(--crema);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            padding: 0.65rem 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .fca-input:focus {
            border-color: var(--dorado);
        }
        .fca-input::placeholder {
            color: rgba(248,245,238,0.25);
        }

        /* ── Confirm Button ── */
        .btn-confirm {
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
            padding: 1rem;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            margin-top: 1.5rem;
        }
        .btn-confirm:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-confirm:active { transform: translateY(0); }

        /* ── IVA Badge ── */
        .iva-badge {
            display: inline-block;
            background: rgba(201,168,76,0.1);
            color: var(--dorado);
            font-family: 'Space Mono', monospace;
            font-size: 0.55rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.15rem 0.5rem;
            border: 1px solid rgba(201,168,76,0.3);
            margin-left: 0.4rem;
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
<section class="checkout-page px-4 px-md-5">

    {{-- Header --}}
    <div class="mb-5 pb-4 border-bottom" style="border-color: var(--border) !important;">
        <p class="section-label mb-1">— Confirmar pedido</p>
        <h1 class="checkout-title">Checkout</h1>
    </div>

    <form action="{{ route('sales.store') }}" method="POST" id="checkout-form">
        @csrf

        <div class="row g-5">

            {{-- Columna ítems --}}
            <div class="col-12 col-lg-8">

                <table class="checkout-table">
                    <thead>
                        <tr>
                            <th colspan="2">Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio unitario</th>
                            <th>Subtotal línea</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td style="width:70px;">
                                <img
                                    src=""
                                    data-cart-img="{{ $item['img_idx'] }}"
                                    class="checkout-product-img"
                                    alt="{{ $item['product']->name }}"
                                >
                            </td>
                            <td>
                                <p class="checkout-product-name mb-1">{{ $item['product']->name }}</p>
                                <p class="checkout-product-price mb-0">{{ $item['product']->description ? Str::limit($item['product']->description, 50) : '' }}</p>
                            </td>
                            <td class="text-center" style="font-family:'Space Mono',monospace; font-size:0.8rem;">
                                {{ $item['quantity'] }}
                            </td>
                            <td class="text-center" style="font-family:'Space Mono',monospace; font-size:0.8rem; color: var(--dorado);">
                                ${{ number_format($item['unit_price'], 2) }}
                            </td>
                            <td style="font-family:'Space Mono',monospace; font-size:0.8rem; color: var(--crema);">
                                ${{ number_format($item['line_total'], 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Datos del comprador --}}
                <div class="mt-5" style="max-width: 420px;">
                    <p style="font-family:'Space Mono',monospace; font-size:0.65rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:1rem;">
                        Datos del comprador <span style="opacity:0.5;">(opcional)</span>
                    </p>
                    <label class="fca-label" for="buyer_name">Nombre completo</label>
                    <input
                        type="text"
                        id="buyer_name"
                        name="buyer_name"
                        class="fca-input"
                        placeholder="Ej. Ana García"
                        value="{{ old('buyer_name') }}"
                        autocomplete="name"
                    >
                </div>

                <div class="mt-4">
                    <a href="{{ route('cart.index') }}" style="color: var(--muted); font-family: 'Space Mono', monospace; font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase; text-decoration:none;">
                        ← Volver al carrito
                    </a>
                </div>
            </div>

            {{-- Columna resumen --}}
            <div class="col-12 col-lg-4">
                <div class="checkout-summary">
                    <p class="checkout-summary-title">Resumen del pedido</p>

                    @foreach($items as $item)
                    <div class="summary-row">
                        <span>{{ Str::limit($item['product']->name, 20) }} ×{{ $item['quantity'] }}</span>
                        <span>${{ number_format($item['line_total'], 2) }}</span>
                    </div>
                    @endforeach

                    <div style="height:1px; background:var(--border); margin:1rem 0;"></div>

                    {{-- Subtotal sin IVA --}}
                    <div class="summary-row">
                        <span>Subtotal <small style="font-size:0.7em; opacity:0.6;">(sin IVA)</small></span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>

                    {{-- IVA --}}
                    <div class="summary-row iva-row">
                        <span>
                            IVA
                            <span class="iva-badge">16%</span>
                        </span>
                        <span>${{ number_format($iva, 2) }}</span>
                    </div>

                    {{-- Total con IVA --}}
                    <div class="summary-total">
                        <span>Total <small style="font-size:0.65em; font-family:'DM Sans',sans-serif; opacity:0.6;">con IVA</small></span>
                        <span>${{ number_format($total, 2) }} MXN</span>
                    </div>

                    <button type="submit" class="btn-confirm" id="btn-confirmar">
                        ✦ Confirmar Compra
                    </button>

                    <p class="text-center mt-3" style="font-family:'Space Mono',monospace; font-size:0.55rem; letter-spacing:0.1em; color:var(--muted); text-transform:uppercase;">
                        ✦ Pago seguro SSL · Envío express CDMX
                    </p>
                </div>
            </div>

        </div>
    </form>

</section>
@endsection

@push('scripts')
<script>
    // Cargar imágenes del carrito desde DummyJSON
    (async () => {
        try {
            const [shirts, dresses, tops] = await Promise.all([
                fetch('https://dummyjson.com/products/category/mens-shirts?select=thumbnail').then(r => r.json()),
                fetch('https://dummyjson.com/products/category/womens-dresses?select=thumbnail').then(r => r.json()),
                fetch('https://dummyjson.com/products/category/tops?select=thumbnail').then(r => r.json()),
            ]);
            const imgs = [...shirts.products, ...dresses.products, ...tops.products].map(p => p.thumbnail);
            document.querySelectorAll('[data-cart-img]').forEach(img => {
                const idx = parseInt(img.getAttribute('data-cart-img')) % imgs.length;
                img.src = imgs[idx];
            });
        } catch {
            document.querySelectorAll('[data-cart-img]').forEach(img => {
                img.src = 'https://via.placeholder.com/56x72/0d120e/c9a84c?text=FCA';
            });
        }
    })();

    // Prevenir doble submit
    document.getElementById('checkout-form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-confirmar');
        btn.disabled = true;
        btn.textContent = 'Procesando...';
    });
</script>
@endpush