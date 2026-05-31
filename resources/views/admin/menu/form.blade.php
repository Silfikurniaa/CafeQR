@extends('layouts.staff')

@section('title', ($item->exists ? 'Edit' : 'Tambah') . ' Menu')

@section('sidebar-nav')
    @include('admin.partials.sidebar', ['active' => 'menu'])
@endsection

@push('styles')
<style>
    .field { margin-bottom: 16px; }
    label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; }
    input, select { width: 100%; max-width: 400px; padding: 10px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 15px; }
    .error { color: #dc3545; font-size: 12px; }
</style>
@endpush

@section('content')
    <h1 class="page-title">{{ $item->exists ? 'Edit Menu' : 'Tambah Menu' }}</h1>

    <div class="card" style="max-width:480px">
        <form method="POST" action="{{ $item->exists ? route('admin.menu.update', $item) : route('admin.menu.store') }}">
            @csrf
            @if ($item->exists) @method('PUT') @endif

            <div class="field">
                <label>Nama menu</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label>Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $item->price) }}" min="0" required>
                @error('price')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label>Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $item->stock ?? 0) }}" min="0" required>
                @error('stock')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label>Kategori</label>
                <select name="category" required>
                    @foreach (['Makanan', 'Minuman'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $item->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Emoji</label>
                <input type="text" name="emoji" value="{{ old('emoji', $item->emoji ?: '🍽️') }}" maxlength="16">
            </div>
            @if ($item->exists)
                <div class="field">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}> Tampilkan ke pelanggan</label>
                </div>
            @endif
            <div style="display:flex;gap:10px;margin-top:20px">
                <button type="submit" class="btn btn-dark">Simpan</button>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
@endsection
