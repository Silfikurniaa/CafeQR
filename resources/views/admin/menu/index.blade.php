@extends('layouts.staff')

@section('title', 'Kelola Menu')

@section('sidebar-nav')
    @include('admin.partials.sidebar', ['active' => 'menu'])
@endsection

@push('styles')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    .menu-row {
        display: flex; align-items: center; gap: 12px; padding: 14px 0;
        border-bottom: 1px solid #eee;
    }
    .menu-thumb { width: 52px; height: 52px; background: #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
    .menu-row-info { flex: 1; }
    .actions { display: flex; gap: 6px; flex-wrap: wrap; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1 class="page-title" style="margin:0">Kelola Menu</h1>
        <a href="{{ route('admin.menu.create') }}" class="btn btn-dark">+ Tambah Menu</a>
    </div>

    <div class="card">
        @forelse ($items as $item)
            <div class="menu-row {{ $item->is_active ? '' : 'opacity-50' }}">
                <div class="menu-thumb">{{ $item->emoji }}</div>
                <div class="menu-row-info">
                    <strong>{{ $item->name }}</strong>
                    <div style="font-size:13px;color:#2e7d32;font-weight:600">
                        Rp {{ number_format($item->price, 0, ',', '.') }} · Stok: {{ $item->stockLabel() }}
                    </div>
                    <div style="font-size:12px;color:#888">{{ $item->category }}</div>
                </div>
                <div class="actions">
                    <a href="{{ route('admin.menu.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.menu.toggle', $item) }}">@csrf @method('PATCH')
                        <button class="btn btn-outline btn-sm">{{ $item->is_active ? 'Nonaktif' : 'Aktif' }}</button>
                    </form>
                    <form method="POST" action="{{ route('admin.menu.destroy', $item) }}" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="padding:20px;text-align:center;color:#999">Belum ada menu.</p>
        @endforelse
    </div>
@endsection
