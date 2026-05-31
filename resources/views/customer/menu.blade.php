<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Meja {{ $table }}</title>
    <meta name="theme-color" content="#8eb8e8">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #ececec;
            min-height: 100vh;
        }

        .page {
            max-width: 480px;
            margin: 0 auto;
            background: #fff;
            min-height: 100vh;
            box-shadow: 0 0 0 1px #ddd;
        }

        .navbar {
            background: #8eb8e8;
            padding: 16px;
            text-align: center;
        }

        .navbar h1 {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
        }

        .table-info {
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #eee;
        }

        .table-icon {
            width: 28px;
            height: 28px;
            display: grid;
            place-items: center;
            font-size: 18px;
        }

        .table-info h2 {
            font-size: 17px;
            font-weight: 700;
            color: #111;
        }

        .filter-bar {
            padding: 12px 16px;
            display: flex;
            gap: 10px;
            border-bottom: 1px solid #eee;
        }

        .filter-btn {
            padding: 7px 18px;
            border-radius: 8px;
            border: 1.5px solid #333;
            background: #fff;
            color: #222;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .filter-btn.active {
            background: #c8e6c9;
            border-color: #2e7d32;
            color: #1b5e20;
            font-weight: 600;
        }

        .menu-list {
            padding-bottom: 100px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-bottom: 1px solid #e8e8e8;
        }

        .menu-thumb {
            width: 56px;
            height: 56px;
            background: #d9d9d9;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .menu-info { flex: 1; }

        .menu-name {
            font-size: 15px;
            font-weight: 500;
            color: #111;
        }

        .menu-price {
            color: #2e7d32;
            font-weight: 600;
            font-size: 14px;
            margin-top: 4px;
        }

        .add-btn {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            border: 1.5px solid #333;
            background: #fff;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
        }

        .qty-ctrl {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1.5px solid #333;
            background: #fff;
            font-size: 18px;
            cursor: pointer;
        }

        .qty-btn.plus {
            background: #8eb8e8;
            border-color: #6a9fd4;
            color: #fff;
        }

        .qty-num {
            font-weight: 700;
            min-width: 18px;
            text-align: center;
        }

        .cart-bar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            padding: 14px 16px;
            background: #fff;
            border-top: 1px solid #eee;
            display: none;
        }

        .cart-bar.visible { display: block; }

        .cart-btn {
            width: 100%;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Halaman keranjang (layar penuh seperti mockup) */
        .cart-screen {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 200;
            background: #ececec;
        }

        .cart-screen.open { display: block; }

        .cart-page {
            max-width: 480px;
            margin: 0 auto;
            background: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .cart-header {
            background: #8eb8e8;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #fff;
        }

        .cart-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 16px;
        }

        .cart-back {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            line-height: 1;
        }

        .cart-header-table {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .cart-body {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
        }

        .cart-body h3 {
            font-size: 16px;
            margin-bottom: 14px;
            color: #111;
        }

        .cart-item {
            padding: 14px 0;
            border-bottom: 1px solid #e8e8e8;
        }

        .cart-item-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .cart-thumb {
            width: 56px;
            height: 56px;
            background: #d9d9d9;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .cart-item-info { flex: 1; }

        .cart-item-name {
            font-size: 15px;
            font-weight: 500;
        }

        .cart-item-price {
            color: #2e7d32;
            font-weight: 600;
            font-size: 14px;
            margin-top: 4px;
        }

        .cart-item-note {
            width: 100%;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
        }

        .summary {
            margin-top: 20px;
            padding-top: 12px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 16px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .cart-footer {
            padding: 16px;
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #eee;
        }

        .submit-btn {
            background: #111;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="page" id="menuPage">
        <div class="navbar">
            <h1>{{ config('app.name') }}</h1>
        </div>

        <div class="table-info">
            <span class="table-icon">▦</span>
            <h2>Meja {{ $table }}</h2>
        </div>

        <div class="filter-bar">
            @foreach (['Semua', 'Makanan', 'Minuman'] as $cat)
                <a href="?filter={{ $cat }}" class="filter-btn {{ $filter === $cat ? 'active' : '' }}">{{ $cat }}</a>
            @endforeach
        </div>

        <div class="menu-list">
            @if (empty($filtered))
                <p style="padding:24px 16px;text-align:center;color:#888;">Menu belum tersedia. Hubungi kasir.</p>
            @endif
            @foreach ($filtered as $item)
                <div class="menu-item">
                    <div class="menu-thumb">{{ $item['emoji'] }}</div>
                    <div class="menu-info">
                        <div class="menu-name">{{ $item['name'] }}</div>
                        <div class="menu-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                    </div>
                    <div class="qty-ctrl" id="ctrl-{{ $item['id'] }}">
                        <button type="button" class="add-btn" onclick="addItem({{ $item['id'] }})">+</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="cart-bar" id="cartBar">
            <button type="button" class="cart-btn" onclick="openCart()">
                Lihat Keranjang ( <span id="cartCount">0</span> item )
            </button>
        </div>
    </div>

    <!-- Layar detail pesanan (mockup halaman 2) -->
    <div class="cart-screen" id="cartScreen">
        <div class="cart-page">
            <div class="cart-header">
                <div class="cart-header-left">
                    <button type="button" class="cart-back" onclick="closeCart()">←</button>
                    <span>Detail Pesanan</span>
                </div>
                <div class="cart-header-table">
                    <span>▦</span> Meja {{ $table }}
                </div>
            </div>

            <div class="cart-body">
                <h3>Pesanan Kamu</h3>
                <div id="cartItems"></div>
                <div class="summary" id="cartSummary"></div>
            </div>

            <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="table_id" value="{{ $table }}">
                <div id="hiddenItems"></div>
                <div class="cart-footer">
                    <button type="submit" class="submit-btn">Kirim Pesanan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const menuCatalog = @json(collect($menuItems)->keyBy('id'));
        let cart = {};

        function fmt(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        function addItem(id) {
            const meta = menuCatalog[id];
            if (!meta) return;
            if (!cart[id]) cart[id] = { id, name: meta.name, price: meta.price, emoji: meta.emoji, qty: 0, note: '' };
            cart[id].qty++;
            updateCtrl(id);
            updateCartBar();
        }

        function removeItem(id) {
            if (!cart[id]) return;
            cart[id].qty--;
            if (cart[id].qty <= 0) delete cart[id];
            updateCtrl(id);
            updateCartBar();
            if (document.getElementById('cartScreen').classList.contains('open')) {
                renderCart();
                if (Object.keys(cart).length === 0) closeCart();
            }
        }

        function updateCtrl(id) {
            const ctrl = document.getElementById('ctrl-' + id);
            const item = cart[id];
            if (!item || item.qty === 0) {
                ctrl.innerHTML = `<button type="button" class="add-btn" onclick="addItem(${id})">+</button>`;
            } else {
                ctrl.innerHTML = `
                    <div class="qty-ctrl">
                        <button type="button" class="qty-btn" onclick="removeItem(${id})">−</button>
                        <span class="qty-num">${item.qty}</span>
                        <button type="button" class="qty-btn plus" onclick="addItem(${id})">+</button>
                    </div>`;
            }
        }

        function updateCartBar() {
            const total = Object.values(cart).reduce((s, i) => s + i.qty, 0);
            document.getElementById('cartCount').textContent = total;
            document.getElementById('cartBar').className = 'cart-bar' + (total > 0 ? ' visible' : '');
        }

        function openCart() {
            renderCart();
            document.getElementById('cartScreen').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeCart() {
            document.getElementById('cartScreen').classList.remove('open');
            document.body.style.overflow = '';
        }

        function renderCart() {
            const items = Object.values(cart);
            let html = '';
            items.forEach(item => {
                html += `
                <div class="cart-item">
                    <div class="cart-item-row">
                        <div class="cart-thumb">${item.emoji}</div>
                        <div class="cart-item-info">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">${fmt(item.price)}</div>
                        </div>
                        <div class="qty-ctrl">
                            <button type="button" class="qty-btn" onclick="removeItem(${item.id})">−</button>
                            <span class="qty-num">${item.qty}</span>
                            <button type="button" class="qty-btn plus" onclick="addItem(${item.id});renderCart()">+</button>
                        </div>
                    </div>
                    <input class="cart-item-note" placeholder="Catatan: tidak pedas, tanpa bawang..."
                        value="${item.note.replace(/"/g, '&quot;')}"
                        oninput="cart[${item.id}].note=this.value; syncHidden()" />
                </div>`;
            });
            document.getElementById('cartItems').innerHTML = html;

            const total = items.reduce((s, i) => s + i.price * i.qty, 0);
            let sumHtml = items.map(i =>
                `<div class="summary-row"><span>${i.name} x${i.qty}</span><span>${fmt(i.price * i.qty)}</span></div>`
            ).join('');
            sumHtml += `<div class="summary-total"><span>Total</span><span>${fmt(total)}</span></div>`;
            document.getElementById('cartSummary').innerHTML = sumHtml;

            syncHidden();
        }

        function syncHidden() {
            const items = Object.values(cart);
            let hiddenHtml = '';
            items.forEach((item, idx) => {
                hiddenHtml += `
                <input type="hidden" name="items[${idx}][id]" value="${item.id}">
                <input type="hidden" name="items[${idx}][name]" value="${item.name.replace(/"/g, '&quot;')}">
                <input type="hidden" name="items[${idx}][price]" value="${item.price}">
                <input type="hidden" name="items[${idx}][emoji]" value="${item.emoji}">
                <input type="hidden" name="items[${idx}][qty]" value="${item.qty}">
                <input type="hidden" name="items[${idx}][note]" value="${(item.note || '').replace(/"/g, '&quot;')}">`;
            });
            document.getElementById('hiddenItems').innerHTML = hiddenHtml;
        }

        document.getElementById('orderForm').addEventListener('submit', syncHidden);
    </script>
</body>

</html>
