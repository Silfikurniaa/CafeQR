<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu — Kasir</title>
    @include('kasir.partials.styles')
    <style>
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            gap: 10px;
        }

        .page-header h2 { font-size: 18px; color: #222; }

        .menu-card {
            background: #fff;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 10px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-card.inactive { opacity: 0.55; }

        .menu-emoji {
            width: 48px;
            height: 48px;
            background: #eee;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .menu-info { flex: 1; min-width: 0; }

        .menu-name { font-weight: 600; font-size: 15px; }

        .menu-meta { font-size: 13px; color: #666; margin-top: 2px; }

        .menu-price { color: #2e7d32; font-weight: 600; }

        .menu-actions {
            display: flex;
            flex-direction: column;
            gap: 6px;
            align-items: flex-end;
        }

        .badge {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 20px;
            font-weight: 600;
        }

        .badge-on { background: #d4edda; color: #155724; }
        .badge-off { background: #f8d7da; color: #721c24; }

        .empty {
            text-align: center;
            padding: 40px;
            color: #999;
            background: #fff;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    @include('kasir.partials.nav', ['active' => 'menu'])

    <div class="content">
        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        <div class="page-header">
            <h2>Kelola Menu</h2>
            <a href="{{ route('kasir.menu.create') }}" class="btn btn-dark">+ Tambah Menu</a>
        </div>

        <p style="font-size:13px;color:#666;margin-bottom:14px;">
            Perubahan langsung tampil di halaman pelanggan (scan QR).
        </p>

        @forelse ($items as $item)
            <div class="menu-card {{ $item->is_active ? '' : 'inactive' }}">
                <div class="menu-emoji">{{ $item->emoji }}</div>
                <div class="menu-info">
                    <div class="menu-name">{{ $item->name }}</div>
                    <div class="menu-meta">
                        {{ $item->category }} ·
                        <span class="menu-price">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="menu-actions">
                    <span class="badge {{ $item->is_active ? 'badge-on' : 'badge-off' }}">
                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end">
                        <a href="{{ route('kasir.menu.edit', $item) }}" class="btn btn-outline">Edit</a>
                        <form method="POST" action="{{ route('kasir.menu.toggle', $item) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-outline">
                                {{ $item->is_active ? 'Sembunyikan' : 'Aktifkan' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('kasir.menu.destroy', $item) }}"
                            onsubmit="return confirm('Hapus menu ini?')" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty">
                Belum ada menu.
                <br><br>
                <a href="{{ route('kasir.menu.create') }}" class="btn btn-primary">Tambah menu pertama</a>
            </div>
        @endforelse
    </div>
</body>

</html>
