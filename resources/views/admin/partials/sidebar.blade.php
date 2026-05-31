<a href="{{ route('admin.dashboard') }}" class="nav-item {{ ($active ?? '') === 'dashboard' ? 'active' : '' }}">
    <span>⊞</span> Dashboard
</a>
<a href="{{ route('admin.menu.index') }}" class="nav-item {{ ($active ?? '') === 'menu' ? 'active' : '' }}">
    <span>🍴</span> Kelola Menu
</a>
<a href="{{ route('admin.tables.index') }}" class="nav-item {{ ($active ?? '') === 'tables' ? 'active' : '' }}">
    <span>🪑</span> Kelola Meja
</a>
<a href="{{ route('admin.kasir.index') }}" class="nav-item {{ ($active ?? '') === 'kasir' ? 'active' : '' }}">
    <span>👥</span> Daftar Kasir
</a>
<a href="{{ route('admin.reports.index') }}" class="nav-item {{ ($active ?? '') === 'reports' ? 'active' : '' }}">
    <span>📊</span> Laporan
</a>
