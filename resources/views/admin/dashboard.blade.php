@extends('layouts.staff')

@section('title', 'Dashboard Admin')

@section('sidebar-nav')
    @include('admin.partials.sidebar', ['active' => 'dashboard'])
@endsection

@push('styles')
<style>
    .section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }
    .section-head h3 { font-size: 16px; font-weight: 700; }
    .menu-mini {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }
    .menu-mini:last-child { border-bottom: none; }
    .menu-thumb {
        width: 48px; height: 48px; background: #ddd; border-radius: 6px;
        display: flex; align-items: center; justify-content: center; font-size: 22px;
    }
    .menu-mini-info { flex: 1; }
    .menu-mini-name { font-weight: 600; font-size: 14px; }
    .menu-mini-price { color: #2e7d32; font-size: 13px; font-weight: 600; }
    .stock-badge {
        font-size: 11px; padding: 3px 8px; border-radius: 20px; font-weight: 600;
    }
    .stock-ok { color: #666; }
    .stock-sedikit { background: #fff3cd; color: #856404; }
    .stock-habis { background: #f8d7da; color: #721c24; }
    .table-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
    }
    .table-tile {
        border: 1.5px solid #ddd;
        border-radius: 10px;
        padding: 12px 8px;
        text-align: center;
        font-size: 13px;
        background: #fff;
    }
    .table-tile.occupied {
        background: #c8e6c9;
        border-color: #2e7d32;
    }
    .table-tile .dot { font-size: 10px; }
    .table-tile a { font-size: 11px; color: #5b8dee; text-decoration: none; display: block; margin-top: 6px; }
    .add-table {
        border: 2px dashed #ccc;
        color: #888;
        display: flex; align-items: center; justify-content: center;
        min-height: 90px; text-decoration: none;
    }
</style>
@endpush

@section('content')
    <h1 class="page-title">Dashboard</h1>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Omset hari ini</div>
            <div class="stat-value">Rp {{ number_format($revenueToday, 0, ',', '.') }}</div>
            <div class="stat-sub {{ $revenuePct < 0 ? 'down' : '' }}">
                {{ $revenuePct >= 0 ? '↑' : '↓' }} {{ abs($revenuePct) }}% vs kemarin
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total transaksi</div>
            <div class="stat-value">{{ $ordersToday }}</div>
            <div class="stat-sub {{ $orderDiff < 0 ? 'down' : '' }}">
                {{ $orderDiff >= 0 ? '↑' : '↓' }} {{ abs($orderDiff) }} vs kemarin
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Meja</div>
            <div class="stat-value">{{ $occupiedCount }}/{{ $totalTables }}</div>
            <div class="stat-sub" style="color:#666">Dari {{ $totalTables }} meja total</div>
        </div>
        <div class="stat-card warn">
            <div class="stat-label">Stok hampir habis</div>
            <div class="stat-value">{{ $lowStockCount }} Item</div>
            <div class="stat-sub down">⚠ Perlu restok segera</div>
        </div>
    </div>

    <div class="grid-2">
        <div class="card">
            <div class="section-head">
                <h3>Kelola Menu</h3>
                <a href="{{ route('admin.menu.create') }}" class="btn btn-dark btn-sm">+ Tambah</a>
            </div>
            @foreach ($menuPreview as $item)
                <div class="menu-mini">
                    <div class="menu-thumb">{{ $item->emoji }}</div>
                    <div class="menu-mini-info">
                        <div class="menu-mini-name">{{ $item->name }}</div>
                        <div class="menu-mini-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                    </div>
                    @php $st = $item->stockStatus(); @endphp
                    <span class="stock-badge stock-{{ $st }}">
                        @if ($st === 'habis') Habis
                        @elseif ($st === 'sedikit') ⚠ Sedikit
                        @else Stok {{ $item->stock }}
                        @endif
                    </span>
                </div>
            @endforeach
            <a href="{{ route('admin.menu.index') }}" style="font-size:13px;color:#5b8dee;margin-top:12px;display:inline-block">Lihat semua menu →</a>
        </div>

        <div class="card">
            <div class="section-head">
                <h3>Meja &amp; QR Code</h3>
                <a href="{{ route('admin.tables.index') }}" class="btn btn-outline btn-sm">Kelola</a>
            </div>
            <div class="table-grid">
                @foreach ($tablesWithStatus as $row)
                    <div class="table-tile {{ $row['occupied'] ? 'occupied' : '' }}">
                        <strong>Meja {{ $row['table']->code }}</strong>
                        <div class="dot">{{ $row['occupied'] ? '🟢 Aktif' : '○ Kosong' }}</div>
                        <a href="{{ $row['table']->qrImageUrl() }}" download="qr-{{ $row['table']->code }}.png" target="_blank">QR ↓</a>
                    </div>
                @endforeach
                <a href="{{ route('admin.tables.index') }}" class="table-tile add-table">+ Tambah Meja baru</a>
            </div>
        </div>
    </div>
@endsection
