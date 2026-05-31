@extends('layouts.staff')

@section('title', 'Daftar Kasir')

@section('sidebar-nav')
    @include('admin.partials.sidebar', ['active' => 'kasir'])
@endsection

@push('styles')
<style>
    .kasir-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 14px 0; border-bottom: 1px solid #eee;
    }
    .register-card {
        background: #eef4fc;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid #c5daf5;
    }
    .register-card h3 { font-size: 16px; margin-bottom: 8px; color: #1a4a8a; }
    .register-card p { font-size: 13px; color: #555; margin-bottom: 16px; line-height: 1.5; }
    .add-form { display: grid; gap: 10px; max-width: 420px; }
    .add-form input { padding: 10px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 14px; }
    .credential-box {
        background: #fff;
        border: 2px dashed #43a047;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 20px;
    }
    .credential-box strong { color: #2e7d32; }
</style>
@endpush

@section('content')
    <h1 class="page-title">Daftar &amp; Kelola Kasir</h1>

    @if (session('kasir_created'))
        <div class="credential-box">
            <strong>✓ Akun kasir berhasil didaftarkan</strong>
            <p style="margin-top:10px;font-size:14px;line-height:1.6">
                Berikan data login ini ke kasir:<br>
                <strong>Email:</strong> {{ session('kasir_created.email') }}<br>
                <strong>Password:</strong> {{ session('kasir_created.password') }}
            </p>
            <p style="font-size:12px;color:#888;margin-top:8px">Kasir bisa login di halaman login staff.</p>
        </div>
    @endif

    <div class="register-card">
        <h3>+ Daftar Kasir Baru</h3>
        <p>
            Admin membuat akun kasir di sini. Setelah didaftarkan, kasir <strong>hanya bisa login</strong>
            — tidak ada pendaftaran mandiri. Pastikan email &amp; password diteruskan ke kasir.
        </p>
        <form method="POST" action="{{ route('admin.kasir.store') }}" class="add-form">
            @csrf
            <input type="text" name="name" placeholder="Nama lengkap kasir" value="{{ old('name') }}" required>
            <input type="email" name="email" placeholder="Email login" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password awal (min. 6 karakter)" required minlength="6">
            @error('email')<div style="color:#dc3545;font-size:12px">{{ $message }}</div>@enderror
            @error('password')<div style="color:#dc3545;font-size:12px">{{ $message }}</div>@enderror
            <button type="submit" class="btn btn-dark" style="width:fit-content">Daftarkan Kasir</button>
        </form>
    </div>

    <div class="card">
        <h3 style="font-size:15px;margin-bottom:12px">Kasir terdaftar ({{ $kasirs->count() }})</h3>
        @forelse ($kasirs as $kasir)
            <div class="kasir-row">
                <div>
                    <strong>{{ $kasir->name }}</strong>
                    <div style="font-size:13px;color:#666">{{ $kasir->email }}</div>
                    <div style="font-size:11px;color:#aaa">Terdaftar {{ $kasir->created_at->format('d M Y') }}</div>
                </div>
                <form method="POST" action="{{ route('admin.kasir.destroy', $kasir) }}" onsubmit="return confirm('Hapus akun kasir ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        @empty
            <p style="text-align:center;color:#999;padding:24px">Belum ada kasir. Daftarkan kasir pertama di atas.</p>
        @endforelse
    </div>
@endsection
