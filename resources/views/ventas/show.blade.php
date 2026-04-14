@extends('layouts.app')

@section('title', 'Detalle Venta #{{ str_pad($sale->id, 6, "0", STR_PAD_LEFT) }} — Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        .detail-page { min-height: 100vh; padding-top: 110px; background: var(--verde); }
        .detail-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            color: var(--crema);
        }
        .detail-meta {
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
        }
        .detail-card {
            background: var(--verde-mid);
            border: 1px solid var(--border);
            padding: 2rem;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
        }
        .detail-table th {
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 0 1rem 0.8rem;
            font-weight: 400;
            border-bottom: 1px solid var(--border);
        }
        .detail-table th:first-child { padding-left: 0; }
        .detail-table th:last-child  { text-align: right; padding-right: 0; }
        .detail-table td {
            padding: 1rem 1rem;
            border-bottom: 1px solid rgba(201,168,76,0.07);
            color: var(--crema);
        }
        .detail-table td:first-child { padding-left: 0; }
        .detail-table td:last-child  { text-align: right; padding-right: 0; }
        .totals-section { margin-top: 1.5rem; }
        .totals-row {
            display: flex;
            justify-content: space-between;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: rgba(248,245,238,0.65);
            padding: 0.4rem 0;
        }
        .totals-row.iva { color: rgba(201,168,76,0.75); }
        .totals-row.final {
            font-family: 'Space Mono', monospace;
            font-size: 1rem;
            color: var(--crema);
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
        }
        .totals-row.final span:last-child { color: var(--dorado); }
        .btn-back {
            color: var(--muted);
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid var(--border);
            transition: color 0.2s, border-color 0.2s;
        }
        .btn-back:hover { color: var(--crema); border-color: var(--crema); }
    </style>
@endpush

@section('content')
<section class="detail-page px-4 px-md-5">

    {{-- Header --}}
    <div class="d-flex align-items-start justify-content-between mb-5 pb-4 border-bottom" style="border-color:var(--border) !important;">
        <div>
            <p class="section-label mb-1">— Detalle de venta</p>
            <h1 class="detail-title">Folio #{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</h1>
            <p class="detail-meta mt-2">
                {{ $sale->created_at->format('d/m/Y \a \l\a\s H:i') }}
                @if($sale->buyer_name)
                    &nbsp;·&nbsp; {{ $sale->buyer_name }}
                @endif
            </p>
        </div>
        <a href="{{ route('sales.index') }}" class="btn-back mt-2">← Volver</a>
    </div>

    <div class="row g-5">

        {{-- Tabla de ítems --}}
        <div class="col-12 col-lg-8">
            <div class="detail-card">
                <p style="font-family:'Space Mono',monospace; font-size:0.62rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:1.5rem;">
                    Productos adquiridos
                </p>
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio unit.</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
                        <tr>
                            <td>
                                <span style="font-weight:600;">{{ $item->product_name }}</span>
                                @if($item->product)
                                    <br>
                                    <span style="font-family:'Space Mono',monospace; font-size:0.65rem; color:var(--muted);">
                                        ID #{{ $item->product_id }}
                                    </span>
                                @else
                                    <br>
                                    <span style="font-family:'Space Mono',monospace; font-size:0.62rem; color:var(--muted);">(producto eliminado)</span>
                                @endif
                            </td>
                            <td class="text-center" style="font-family:'Space Mono',monospace; font-size:0.8rem;">
                                {{ $item->quantity }}
                            </td>
                            <td class="text-center" style="font-family:'Space Mono',monospace; font-size:0.8rem; color:var(--dorado);">
                                ${{ number_format($item->unit_price, 2) }}
                            </td>
                            <td style="font-family:'Space Mono',monospace; font-size:0.8rem; color:var(--crema);">
                                ${{ number_format($item->line_total, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Resumen de totales --}}
        <div class="col-12 col-lg-4">
            <div class="detail-card">
                <p style="font-family:'Space Mono',monospace; font-size:0.62rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:1.5rem;">
                    Desglose fiscal
                </p>

                <div class="totals-section">
                    <div class="totals-row">
                        <span>Subtotal <small>(sin IVA)</small></span>
                        <span>${{ number_format($sale->subtotal, 2) }}</span>
                    </div>
                    <div class="totals-row iva">
                        <span>IVA (16%)</span>
                        <span>+ ${{ number_format($sale->iva, 2) }}</span>
                    </div>
                    <div class="totals-row final">
                        <span>Total pagado</span>
                        <span>${{ number_format($sale->total, 2) }} MXN</span>
                    </div>
                </div>

                @if($sale->buyer_name)
                <div style="margin-top:1.5rem; padding-top:1.25rem; border-top:1px solid var(--border);">
                    <p class="detail-meta mb-1">Comprador</p>
                    <p style="color:var(--crema); font-family:'DM Sans',sans-serif; font-size:0.9rem;">
                        {{ $sale->buyer_name }}
                    </p>
                </div>
                @endif

                <div style="margin-top:1.5rem; padding-top:1.25rem; border-top:1px solid var(--border);">
                    <p class="detail-meta mb-1">Fecha de compra</p>
                    <p style="color:var(--crema); font-family:'DM Sans',sans-serif; font-size:0.85rem;">
                        {{ $sale->created_at->format('d \d\e F Y, H:i \h\r\s') }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
