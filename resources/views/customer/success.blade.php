<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Terkirim — {{ config('app.name') }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, sans-serif;
            background: #ececec;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .page {
            max-width: 400px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            padding: 40px 28px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .icon { font-size: 56px; margin-bottom: 16px; }

        h2 { font-size: 22px; color: #111; margin-bottom: 8px; }

        p { color: #666; font-size: 15px; line-height: 1.5; margin-bottom: 24px; }

        a {
            display: inline-block;
            background: #111;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="icon">✅</div>
        <h2>Pesanan Terkirim!</h2>
        <p>Pesanan untuk <strong>Meja {{ $table }}</strong> sudah masuk ke dapur. Mohon tunggu ya!</p>
        <a href="{{ route('customer.menu', ['table' => $table]) }}">Pesan Lagi</a>
    </div>
</body>

</html>
