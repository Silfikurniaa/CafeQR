<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staff — {{ config('app.name') }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, sans-serif;
            background: #ececec;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 32px 28px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        h1 { font-size: 22px; margin-bottom: 6px; color: #111; }

        .subtitle { font-size: 14px; color: #666; margin-bottom: 20px; line-height: 1.5; }

        .info-box {
            background: #eef4fc;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            color: #3d6fd4;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #444; }

        input {
            width: 100%;
            padding: 11px 12px;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            margin-bottom: 14px;
        }

        .error { color: #dc3545; font-size: 13px; margin: -10px 0 12px; }

        button {
            width: 100%;
            padding: 13px;
            background: #9ec5f0;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover { background: #8ab5e8; }

        .back { display: block; text-align: center; margin-top: 16px; font-size: 13px; color: #888; }
    </style>
</head>

<body>
    <div class="card">
        <h1>{{ config('app.name') }}</h1>
        <p class="subtitle">Login untuk Admin &amp; Kasir</p>

        <div class="info-box">
            <strong>Admin</strong> — kelola sistem (menu, meja, daftar kasir).<br>
            <strong>Kasir</strong> — akun dibuat oleh admin dulu, lalu login dengan email &amp; password yang diberikan admin. Tidak bisa daftar sendiri.
        </div>

        @if (session('status'))
            <div class="info-box" style="background:#d4edda;color:#155724">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label style="display:flex;align-items:center;gap:8px;font-weight:400;margin-bottom:16px">
                <input type="checkbox" name="remember" style="width:auto;margin:0"> Ingat saya
            </label>

            <button type="submit">Masuk</button>
        </form>

        <a href="{{ route('home') }}" class="back">← Kembali ke halaman pelanggan</a>
    </div>
</body>

</html>
