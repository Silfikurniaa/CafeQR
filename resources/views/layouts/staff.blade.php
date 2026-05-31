<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #9ec5f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar-brand {
            padding: 20px 16px;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
        }

        .sidebar-user {
            padding: 0 16px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 14px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 8px 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .nav-item:hover { background: rgba(255, 255, 255, 0.15); }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.35);
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 16px 10px;
        }

        .main {
            flex: 1;
            padding: 24px 28px;
            overflow-x: auto;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 20px;
        }

        .flash {
            background: #d4edda;
            color: #155724;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        }

        .stat-card.warn { background: #fff8e6; }

        .stat-label { font-size: 13px; color: #666; margin-bottom: 6px; }

        .stat-value { font-size: 22px; font-weight: 700; color: #111; }

        .stat-sub { font-size: 12px; margin-top: 6px; color: #2e7d32; }

        .stat-sub.down { color: #c62828; }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-dark { background: #111; color: #fff; }
        .btn-primary { background: #5b8dee; color: #fff; }
        .btn-outline { background: #fff; color: #333; border: 1.5px solid #ddd; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 900px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; min-height: auto; }
            .grid-2 { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-brand">{{ config('app.name') }}</div>
        <div class="sidebar-user">
            <div class="avatar">{{ auth()->user()->isAdmin() ? '👑' : '👤' }}</div>
            <span>{{ auth()->user()->name }}</span>
        </div>
        <nav class="sidebar-nav">
            @yield('sidebar-nav')
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item" style="width:100%;border:none;background:transparent;cursor:pointer">
                    <span>⎋</span> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
