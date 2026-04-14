@extends('layouts.app')

@section('title', 'Ventas Registradas — Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        .sale-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.58rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: rgba(201,168,76,0.1);
            color: var(--dorado);
            border: 1px solid rgba(201,168,76,0.3);
        }
        .btn-detail {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            font-family: 'Space Mono', monospace;
            font-size: 0.58rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.3rem 0.7rem;
            text-decoration: none;
            transition: color 0.2s, border-color 0.2s;
        }
        .btn-detail:hover {
            color: var(--dorado);
            border-color: var(--dorado);
        }
        .stat-card {
            background: var(--verde-mid);
            border: 1px solid var(--border);
            padding: 1.5rem;
            text-align: center;
        }
        .stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--dorado);
            line-height: 1;
        }
        .stat-label {
            font-family: 'Space Mono', monospace;
            font-size: 0.58rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 0.4rem;
        }
    </style>
@endpush

@section('content')
<div class="container py-5 mt-5">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 pb-3 border-bottom" style="border-color: var(--border) !important;">
        <div>
            <p class="section-label mb-2">— Panel de Control</p>
            <h1 class="section-title m-0 fs-2">Ventas Registradas</h1>
            <p class="mt-2 mb-0" style="font-size:0.9rem; color:var(--muted);">Historial completo de transacciones de la tienda FCA.</p>
        </div>
        <div class="mt-4 mt-md-0 d-flex gap-2">
            <a href="{{ route('products.index') }}" class="btn-detail">← Productos</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert text-center fw-bold text-uppercase border-0 rounded-0 mb-4" style="background:var(--dorado-dim); color:var(--dorado); font-family:'Space Mono',monospace; font-size:0.75rem; letter-spacing:0.1em;" role="alert">
        ✦ {{ session('success') }} ✦
    </div>
    @endif

    {{-- Stats --}}
    @php
        $totalIngresos = $sales->sum('total');
        $totalSinIva   = $sales->sum('subtotal');
        $totalIva      = $sales->sum('iva');
    @endphp
    <div class="row g-3 mb-5">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-value">{{ $sales->count() }}</div>
                <div class="stat-label">Ventas totales</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-value">${{ number_format($totalSinIva, 0) }}</div>
                <div class="stat-label">Subtotal sin IVA</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-value">${{ number_format($totalIva, 0) }}</div>
                <div class="stat-label">IVA acumulado</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-value">${{ number_format($totalIngresos, 0) }}</div>
                <div class="stat-label">Total ingresos</div>
            </div>
        </div>
    </div>

    {{-- Tabla de ventas --}}
    <div class="table-responsive" style="border:1px solid var(--border);">
        <table class="table table-dark table-hover m-0" style="--bs-table-bg: var(--verde-mid);">
            <thead style="font-family:'Space Mono',monospace; font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase;">
                <tr>
                    <th class="py-3 px-4 text-muted" style="border-color:var(--border) !important; width:70px;">Folio</th>
                    <th class="py-3 px-4 text-muted" style="border-color:var(--border) !important;">Fecha</th>
                    <th class="py-3 px-4 text-muted" style="border-color:var(--border) !important;">Comprador</th>
                    <th class="py-3 px-4 text-muted text-center" style="border-color:var(--border) !important;">Ítems</th>
                    <th class="py-3 px-4 text-muted text-end" style="border-color:var(--border) !important;">Subtotal</th>
                    <th class="py-3 px-4 text-muted text-end" style="border-color:var(--border) !important;">IVA 16%</th>
                    <th class="py-3 px-4 text-muted text-end" style="border-color:var(--border) !important;">Total</th>
                    <th class="py-3 px-4 text-muted" style="border-color:var(--border) !important;"></th>
                </tr>
            </thead>
            <tbody style="border-top:1px solid var(--border); font-family:'DM Sans',sans-serif;">
                @forelse($sales as $sale)
                <tr>
                    <td class="py-3 px-4" style="border-color:var(--border) !important; color:var(--dorado); font-family:'Space Mono',monospace; font-size:0.75rem;">
                        #{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-3 px-4" style="border-color:var(--border) !important; font-size:0.85rem; color:rgba(248,245,238,0.7);">
                        {{ $sale->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="py-3 px-4" style="border-color:var(--border) !important;">
                        @if($sale->buyer_name)
                            <span class="fw-bold">{{ $sale->buyer_name }}</span>
                        @else
                            <span style="color:var(--muted); font-size:0.8rem;">— Anónimo</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center" style="border-color:var(--border) !important;">
                        <span class="sale-badge">{{ $sale->items->count() }} art.</span>
                    </td>
                    <td class="py-3 px-4 text-end" style="border-color:var(--border) !important; font-family:'Space Mono',monospace; font-size:0.8rem;">
                        ${{ number_format($sale->subtotal, 2) }}
                    </td>
                    <td class="py-3 px-4 text-end" style="border-color:var(--border) !important; font-family:'Space Mono',monospace; font-size:0.8rem; color:rgba(201,168,76,0.7);">
                        ${{ number_format($sale->iva, 2) }}
                    </td>
                    <td class="py-3 px-4 text-end" style="border-color:var(--border) !important; font-family:'Space Mono',monospace; font-size:0.85rem; color:var(--dorado); font-weight:700;">
                        ${{ number_format($sale->total, 2) }}
                    </td>
                    <td class="py-3 px-4" style="border-color:var(--border) !important;">
                        <a href="{{ route('sales.show', $sale->id) }}" class="btn-detail">Ver →</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-5 text-center text-muted" style="border-color:var(--border) !important; font-family:'DM Sans',sans-serif;">
                        <p class="mb-2">No hay ventas registradas aún.</p>
                        <a href="{{ route('catalog') }}" style="color:var(--dorado); text-decoration:none; font-family:'Space Mono',monospace; font-size:0.7rem;">
                            Ver catálogo →
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
