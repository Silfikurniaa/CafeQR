@extends('layouts.staff')

@section('title', 'Laporan')

@section('sidebar-nav')
    @include('admin.partials.sidebar', ['active' => 'reports'])
@endsection

@push('styles')
<style>
    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
    th { color: #666; font-weight: 600; }
</style>
@endpush

@section('content')
    <h1 class="page-title">Laporan</h1>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">7 hari terakhir</div>
            <div class="stat-value">{{ $totalOrders }} transaksi</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total omset</div>
            <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="card" style="margin-bottom:20px">
        <h3 style="margin-bottom:12px">Ringkasan per hari</h3>
        <table>
            <thead><tr><th>Tanggal</th><th>Transaksi</th><th>Omset</th></tr></thead>
            <tbody>
                @foreach ($byDay as $day)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($day['date'])->format('d M Y') }}</td>
                        <td>{{ $day['count'] }}</td>
                        <td>Rp {{ number_format($day['revenue'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3 style="margin-bottom:12px">Detail pesanan</h3>
        <table>
            <thead><tr><th>Waktu</th><th>Meja</th><th>Total</th><th>Status</th></tr></thead>
            <tbody>
                @foreach ($orders->take(50) as $order)
                    <tr>
                        <td>{{ $order->created_at->format('d/m H:i') }}</td>
                        <td>{{ $order->table_id }}</td>
                        <td>Rp {{ number_format($order->totalAmount(), 0, ',', '.') }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
