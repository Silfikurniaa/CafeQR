<div class="navbar">
    <h1>{{ config('app.name') }} — Kasir</h1>
    <div class="navbar-right">
        <a href="{{ route('dashboard') }}" class="nav-btn {{ ($active ?? '') === 'orders' ? 'active' : '' }}">Pesanan</a>
        <a href="{{ route('kasir.menu.index') }}" class="nav-btn {{ ($active ?? '') === 'menu' ? 'active' : '' }}">Menu</a>
        <a href="{{ route('kasir.qr') }}" class="nav-btn {{ ($active ?? '') === 'qr' ? 'active' : '' }}">QR Meja</a>
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="nav-btn">Keluar</button>
        </form>
    </div>
</div>
