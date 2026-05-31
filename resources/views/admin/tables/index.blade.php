@extends('layouts.staff')

@section('title', 'Kelola Meja')

@section('sidebar-nav')
    @include('admin.partials.sidebar', ['active' => 'tables'])
@endsection

@push('styles')
<style>
    .table-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; margin-top: 16px; }
    .table-card {
        background: #fff; border: 1.5px solid #ddd; border-radius: 12px; padding: 16px; text-align: center;
    }
    .table-card.occupied { background: #e8f5e9; border-color: #2e7d32; }
    .table-card.inactive { opacity: 0.5; }
    .add-form { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
    .add-form input { padding: 10px; border: 1.5px solid #ddd; border-radius: 8px; width: 120px; }
</style>
@endpush

@section('content')
    <h1 class="page-title">Kelola Meja</h1>

    <div class="card">
        <form method="POST" action="{{ route('admin.tables.store') }}" class="add-form">
            @csrf
            <input type="text" name="code" placeholder="Kode meja (A9)" required maxlength="16">
            <button type="submit" class="btn btn-dark">+ Tambah Meja</button>
        </form>
        @error('code')<div style="color:#dc3545;font-size:13px;margin-bottom:10px">{{ $message }}</div>@enderror

        <div class="table-grid">
            @foreach ($tablesWithStatus as $row)
                @php $t = $row['table']; @endphp
                <div class="table-card {{ $row['occupied'] ? 'occupied' : '' }} {{ $t->is_active ? '' : 'inactive' }}">
                    <strong>Meja {{ $t->code }}</strong>
                    <p style="font-size:12px;margin:8px 0">{{ $row['occupied'] ? '🟢 Aktif' : '○ Kosong' }}</p>
                    <img src="{{ $t->qrImageUrl() }}" alt="QR" width="100" height="100" style="margin:8px auto">
                    <a href="{{ $t->qrImageUrl() }}" download class="btn btn-outline btn-sm" style="margin:4px">QR ↓</a>
                    <form method="POST" action="{{ route('admin.tables.toggle', $t) }}" style="margin-top:6px">@csrf @method('PATCH')
                        <button class="btn btn-outline btn-sm">{{ $t->is_active ? 'Nonaktif' : 'Aktif' }}</button>
                    </form>
                    <form method="POST" action="{{ route('admin.tables.destroy', $t) }}" onsubmit="return confirm('Hapus meja?')" style="margin-top:4px">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
