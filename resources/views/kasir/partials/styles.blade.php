<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: system-ui, sans-serif; background: #f5f5f0; min-height: 100vh; }
    .navbar {
        background: #5b8dee;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    .navbar h1 { color: #fff; font-size: 18px; font-weight: 700; }
    .navbar-right { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .navbar-right span { color: rgba(255,255,255,.85); font-size: 13px; }
    .nav-btn {
        background: rgba(255,255,255,.2);
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 6px 12px;
        cursor: pointer;
        font-size: 13px;
        text-decoration: none;
    }
    .nav-btn.active { background: rgba(255,255,255,.35); font-weight: 600; }
    .content { padding: 16px; max-width: 720px; margin: 0 auto; }
    .flash {
        background: #d4edda;
        color: #155724;
        padding: 12px 14px;
        border-radius: 8px;
        margin-bottom: 14px;
        font-size: 14px;
    }
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
    .btn-primary { background: #5b8dee; color: #fff; }
    .btn-dark { background: #222; color: #fff; }
    .btn-danger { background: #dc3545; color: #fff; }
    .btn-outline { background: #fff; color: #333; border: 1.5px solid #ddd; }
</style>
