@extends('layouts.kasir')

@section('title', 'Kasir Dashboard')
@section('header-title', 'Dashboard Kasir')
@php($nav = 'dashboard')

@push('styles')
<style>
    .stats-bar {
        background: #fff;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border-bottom: 1px solid #e0e0e0;
    }

    .stat-cell {
        padding: 16px 20px;
        text-align: center;
        border-right: 1px solid #eee;
    }

    .stat-cell:last-child { border-right: none; }

    .stat-cell .label { font-size: 12px; color: #888; margin-bottom: 4px; }

    .stat-cell .val { font-size: 24px; font-weight: 800; }

    .val.orange { color: #e65100; }
    .val.blue { color: #1565c0; }
    .val.green { color: #2e7d32; }
    .val.dark { color: #111; font-size: 20px; }

    .kanban {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        padding: 20px 24px 40px;
        min-height: calc(100vh - 180px);
        align-items: start;
    }

    @media (max-width: 1000px) {
        .kanban { grid-template-columns: 1fr; }
        .stats-bar { grid-template-columns: repeat(2, 1fr); }
    }

    .kanban-col {
        background: #f5f5f5;
        border-radius: 12px;
        padding: 14px;
        min-height: 200px;
    }

    .col-head {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 14px;
        color: #333;
    }

    .dot { width: 10px; height: 10px; border-radius: 50%; }
    .dot.orange { background: #ff9800; }
    .dot.blue { background: #2196f3; }
    .dot.green { background: #4caf50; }

    .kanban-col.col-baru { background: #fffaf5; }
    .kanban-col.col-masak { background: #f5f9ff; }
    .kanban-col.col-bayar { background: #f5fff7; }

    .o-card {
        background: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .o-card-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .o-card-head .id { font-weight: 700; color: #111; }

    .o-card-head .time { font-size: 12px; color: #999; white-space: nowrap; }

    .o-card-head .total-top {
        font-weight: 700;
        font-size: 13px;
        color: #111;
    }

    .o-items {
        list-style: none;
        font-size: 13px;
        color: #444;
        line-height: 1.65;
        margin-bottom: 10px;
    }

    .o-note {
        background: #fffde7;
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 12px;
        color: #795548;
        margin-bottom: 12px;
        display: flex;
        gap: 6px;
        align-items: flex-start;
    }

    .o-actions { display: flex; gap: 8px; align-items: stretch; }

    .btn-terima {
        flex: 1;
        background: #1e5c38;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-tolak {
        width: 44px;
        background: #fce4ec;
        color: #c62828;
        border: 1px solid #f8bbd9;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        font-weight: 700;
    }

    .btn-masak {
        width: 100%;
        background: #1565c0;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
    }

    .pay-toggle {
        display: flex;
        gap: 8px;
        margin-bottom: 10px;
    }

    .pay-toggle label {
        flex: 1;
        text-align: center;
        padding: 8px;
        border: 1.5px solid #ccc;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        background: #fff;
    }

    .pay-toggle input { display: none; }

    .pay-toggle input:checked + span,
    .pay-toggle label:has(input:checked) {
        border-color: #1e5c38;
        background: #e8f5e9;
        font-weight: 600;
        color: #1e5c38;
    }

    .pay-toggle label:has(input:checked) {
        border-color: #1e5c38;
        background: #e8f5e9;
        font-weight: 600;
    }

    .btn-bayar {
        width: 100%;
        background: #43a047;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
    }

    .col-empty {
        text-align: center;
        color: #bbb;
        font-size: 13px;
        padding: 24px 8px;
    }
</style>
@endpush

@section('content')
    <div class="stats-bar">
        <div class="stat-cell">
            <div class="label">Menunggu</div>
            <div class="val orange">{{ $stats['menunggu'] }}</div>
        </div>
        <div class="stat-cell">
            <div class="label">Diproses</div>
            <div class="val blue">{{ $stats['diproses'] }}</div>
        </div>
        <div class="stat-cell">
            <div class="label">Selesai hari ini</div>
            <div class="val green">{{ $stats['selesai'] }}</div>
        </div>
        <div class="stat-cell">
            <div class="label">Omzet hari ini</div>
            <div class="val dark">{{ \App\Support\Format::omzetSingkat($stats['omzet']) }}</div>
        </div>
    </div>

    <div class="kanban">
        {{-- Kolom 1: Baru Masuk --}}
        <div class="kanban-col col-baru">
            <div class="col-head"><span class="dot orange"></span> Baru Masuk ({{ $baruMasuk->count() }})</div>
            @forelse ($baruMasuk as $order)
                <div class="o-card">
                    <div class="o-card-head">
                        <span class="id">{{ $order->orderCode() }} • Meja {{ $order->table_id }}</span>
                        <span class="time">{{ $order->created_at->locale('id')->diffForHumans() }}</span>
                    </div>
                    <ul class="o-items">
                        @foreach ($order->items ?? [] as $item)
                            <li>{{ $item['name'] }} ×{{ $item['qty'] }}</li>
                        @endforeach
                    </ul>
                    @foreach ($order->itemNotes() as $note)
                        <div class="o-note">💬 {{ $note }}</div>
                    @endforeach
                    <div class="o-actions">
                        <form method="POST" action="{{ route('kasir.orders.terima', $order) }}" style="flex:1">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-terima">Terima ✓</button>
                        </form>
                        <form method="POST" action="{{ route('kasir.orders.tolak', $order) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-tolak" onclick="return confirm('Tolak pesanan ini?')">✕</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-empty">Belum ada pesanan baru</div>
            @endforelse
        </div>

        {{-- Kolom 2: Dimasak --}}
        <div class="kanban-col col-masak">
            <div class="col-head"><span class="dot blue"></span> Dimasak ({{ $dimasak->count() }})</div>
            @forelse ($dimasak as $order)
                <div class="o-card">
                    <div class="o-card-head">
                        <span class="id">{{ $order->orderCode() }} • Meja {{ $order->table_id }}</span>
                        <span class="time">{{ $order->created_at->locale('id')->diffForHumans() }}</span>
                    </div>
                    <ul class="o-items">
                        @foreach ($order->items ?? [] as $item)
                            <li>{{ $item['name'] }} ×{{ $item['qty'] }}</li>
                        @endforeach
                    </ul>
                    <form method="POST" action="{{ route('kasir.orders.siap', $order) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-masak">Tandai Siap 🍽️</button>
                    </form>
                </div>
            @empty
                <div class="col-empty">Tidak ada yang dimasak</div>
            @endforelse
        </div>

        {{-- Kolom 3: Siap Bayar --}}
        <div class="kanban-col col-bayar">
            <div class="col-head"><span class="dot green"></span> Siap Bayar ({{ $siapBayar->count() }})</div>
            @forelse ($siapBayar as $order)
                <div class="o-card">
                    <div class="o-card-head">
                        <span class="id">{{ $order->orderCode() }} • Meja {{ $order->table_id }}</span>
                        <span class="total-top">Total: Rp {{ number_format($order->totalAmount(), 0, ',', '.') }}</span>
                    </div>
                    <ul class="o-items">
                        @foreach ($order->items ?? [] as $item)
                            <li>{{ $item['name'] }} ×{{ $item['qty'] }}</li>
                        @endforeach
                    </ul>
                    <form method="POST" action="{{ route('kasir.orders.bayar', $order) }}" class="pay-form">
                        @csrf
                        <div class="pay-toggle">
                            <label>
                                <input type="radio" name="payment_method" value="cash" checked>
                                Cash
                            </label>
                            <label>
                                <input type="radio" name="payment_method" value="qris">
                                QRIS
                            </label>
                        </div>
                        <button type="submit" class="btn-bayar">Bayar ✓</button>
                    </form>
                </div>
            @empty
                <div class="col-empty">Belum ada yang siap bayar</div>
            @endforelse
        </div>
    </div>
@endsection
