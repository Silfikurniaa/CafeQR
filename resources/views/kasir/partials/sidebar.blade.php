<a href="{{ route('kasir.dashboard') }}" class="nav-item {{ ($active ?? '') === 'orders' ? 'active' : '' }}">
    <span>📋</span> Pesanan
</a>
<a href="{{ route('kasir.qr') }}" class="nav-item {{ ($active ?? '') === 'qr' ? 'active' : '' }}">
    <span>📱</span> QR Meja
</a>
