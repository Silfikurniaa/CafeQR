<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Kasir') — {{ config('app.name') }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #ececec;
            min-height: 100vh;
        }

        .kasir-header {
            background: #9ec5f0;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .kasir-header h1 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        .kasir-header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .kasir-header-right span {
            color: #fff;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-keluar {
            background: rgba(255, 255, 255, 0.25);
            border: none;
            color: #fff;
            padding: 6px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }

        .btn-keluar:hover {
            background: rgba(255, 255, 255, 0.35);
        }

        .kasir-nav {
            background: #fff;
            padding: 10px 20px;
            display: flex;
            gap: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .kasir-nav a {
            font-size: 13px;
            color: #555;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
        }

        .kasir-nav a.active {
            background: #eef4fc;
            color: #3d6fd4;
            font-weight: 600;
        }

        .kasir-body {
            padding: 0;
        }

        .flash {
            margin: 12px 20px 0;
            background: #d4edda;
            color: #155724;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
    @stack('styles')
</head>

<body>
    <header class="kasir-header">
        <h1>@yield('header-title', 'Dashboard Kasir')</h1>
        <div class="kasir-header-right">
            <span>{{ auth()->user()->name }} — Kasir</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn-keluar">Keluar</button>
            </form>
        </div>
    </header>

    <nav class="kasir-nav">
        <a href="{{ route('kasir.dashboard') }}" class="{{ ($nav ?? '') === 'dashboard' ? 'active' : '' }}">Pesanan</a>
        <a href="{{ route('kasir.qr') }}" class="{{ ($nav ?? '') === 'qr' ? 'active' : '' }}">QR Meja</a>
    </nav>

    <div class="kasir-body">
        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>
