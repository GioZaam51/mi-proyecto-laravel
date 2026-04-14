@extends('layouts.app')

@section('title', 'Compra Confirmada #{{ $sale->id }} — FCA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        .confirm-page {
            min-height: 100vh;
            padding-top: 120px;
            padding-bottom: 80px;
            background: var(--verde);
        }
        .confirm-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(201,168,76,0.12);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: pulse-gold 2s ease-in-out infinite;
        }
        @keyframes pulse-gold {
            0%, 100% { box-shadow: 0 0 0 0 rgba(201,168,76,0.3); }
            50%       { box-shadow: 0 0 0 12px rgba(201,168,76,0); }
        }
        .confirm-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            color: var(--crema);
            line-height: 1.1;
        }
        .confirm-folio {
            display: inline-block;
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--dorado);
            background: rgba(201,168,76,0.08);
            border: 1px solid rgba(201,168,76,0.25);
            padding: 0.4rem 1rem;
            margin-bottom: 2rem;
        }
        /* Resumen card */
        .confirm-card {
            background: var(--verde-mid);
            border: 1px solid var(--border);
            padding: 2rem;
            max-width: 560px;
            margin: 2rem auto 0;
        }
        .confirm-table {
            width: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            border-collapse: collapse;
        }
        .confirm-table th {
            font-family: 'Space Mono', monospace;
            font-size: 0.58rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 0 0.5rem 0.75rem;
            font-weight: 400;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        .confirm-table th:last-child { text-align: right; }
        .confirm-table td {
            padding: 0.85rem 0.5rem;
            color: var(--crema);
            border-bottom: 1px solid rgba(201,168,76,0.08);
        }
        .confirm-table td:last-child { text-align: right; font-family:'Space Mono',monospace; font-size:0.78rem; color:var(--dorado); }
        /* Totals */
        .confirm-totals { margin-top: 1.5rem; }
        .confirm-row {
            display: flex;
            justify-content: space-between;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            color: rgba(248,245,238,0.65);
            margin-bottom: 0.5rem;
        }
        .confirm-row.iva { color: rgba(201,168,76,0.75); }
        .confirm-total-final {
            display: flex;
            justify-content: space-between;
            font-family: 'Space Mono', monospace;
            font-size: 1.1rem;
            color: var(--crema);
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
        }
        .confirm-total-final span:last-child { color: var(--dorado); }
        /* CTA buttons */
        .btn-continue {
            display: inline-block;
            background: var(--dorado);
            color: var(--verde);
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border: none;
            padding: 0.85rem 2rem;
            cursor: pointer;
            transition: opacity 0.2s;
            text-decoration: none;
        }
        .btn-continue:hover { opacity: 0.88; color: var(--verde); }
        .btn-catalog {
            display: inline-block;
            color: var(--muted);
            font-family: 'Space Mono', monospace;
            font-size: 0.66rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 0.85rem 1.5rem;
            border: 1px solid var(--border);
            transition: color 0.2s, border-color 0.2s;
        }
        .btn-catalog:hover { color: var(--crema); border-color: var(--crema); }
    </style>
@endpush

@section('content')
<section class="confirm-page px-4">
    <div class="text-center">
        {{-- Icono animado --}}
        <div class="confirm-icon">
            <svg width="32" height="32" fill="none" stroke="#C9A84C" stroke-width="1.5" viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </div>

        <p class="section-label mb-2">— Transacción exitosa</p>
        <h1 class="confirm-title">¡Compra Confirmada!</h1>
        <p style="font-family:'DM Sans',sans-serif; color:rgba(248,245,238,0.6); margin-top:0.75rem;">
            @if($sale->buyer_name)
                Gracias, <strong style="color:var(--crema);">{{ $sale->buyer_name }}</strong>. Tu pedido ha sido registrado.
            @else
                Tu pedido ha sido registrado correctamente.
            @endif
        </p>

        <div class="confirm-folio">Folio #{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</div>
    </div>

    {{-- Resumen de ítems --}}
    <div class="confirm-card">
        <p style="font-family:'Space Mono',monospace; font-size:0.62rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:1.25rem;">
            Detalle del pedido
        </p>

        <table class="confirm-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="text-center">Cant.</th>
                    <th style="text-align:right;">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                <tr>
                    <td>
                        <span style="font-weight:600;">{{ $item->product_name }}</span>
                        <br>
                        <span style="font-family:'Space Mono',monospace; font-size:0.68rem; color:var(--dorado);">
                            ${{ number_format($item->unit_price, 2) }} c/u
                        </span>
                    </td>
                    <td class="text-center" style="font-family:'Space Mono',monospace; font-size:0.8rem;">
                        {{ $item->quantity }}
                    </td>
                    <td>${{ number_format($item->line_total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Totales --}}
        <div class="confirm-totals">
            <div class="confirm-row">
                <span>Subtotal <small>(sin IVA)</small></span>
                <span>${{ number_format($sale->subtotal, 2) }}</span>
            </div>
            <div class="confirm-row iva">
                <span>IVA (16%)</span>
                <span>+ ${{ number_format($sale->iva, 2) }}</span>
            </div>
            <div class="confirm-total-final">
                <span>Total pagado</span>
                <span>${{ number_format($sale->total, 2) }} MXN</span>
            </div>
        </div>
    </div>

    {{-- CTAs --}}
    <div class="d-flex justify-content-center gap-3 mt-5 flex-wrap">
        <a href="{{ route('catalog') }}" class="btn-continue">Seguir comprando →</a>
        <a href="{{ route('catalog') }}" class="btn-catalog">Ver catálogo</a>
    </div>

    <p class="text-center mt-4" style="font-family:'Space Mono',monospace; font-size:0.55rem; letter-spacing:0.1em; color:var(--muted); text-transform:uppercase;">
        ✦ Gracias por tu confianza · FCA Moda Premium
    </p>
</section>
@endsection
