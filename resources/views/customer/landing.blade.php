<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
            background: #f5f5f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 28px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        .logo {
            font-size: 48px;
            margin-bottom: 12px;
        }

        h1 {
            font-size: 24px;
            color: #222;
            margin-bottom: 8px;
        }

        p {
            color: #666;
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .hint {
            background: #eef3ff;
            color: #3d6fd4;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .staff-link {
            display: inline-block;
            color: #888;
            font-size: 13px;
            text-decoration: none;
            margin-top: 8px;
        }

        .staff-link:hover {
            color: #5b8dee;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="logo">☕</div>
        <h1>{{ config('app.name') }}</h1>
        <p>Selamat datang! Pesan makanan & minuman langsung dari HP Anda.</p>
        <div class="hint">
            📱 <strong>Scan QR code</strong> yang ada di meja Anda untuk membuka menu dan memesan.
        </div>
        <a href="{{ route('login') }}" class="staff-link">Masuk staff (admin / kasir) →</a>
    </div>
</body>

</html>
