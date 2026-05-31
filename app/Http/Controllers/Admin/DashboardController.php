<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeTable;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $revenueToday = Order::revenueToday();
        $revenueYesterday = Order::revenueYesterday();
        $ordersToday = Order::countToday();
        $ordersYesterday = Order::countYesterday();

        $revenuePct = $revenueYesterday > 0
            ? round((($revenueToday - $revenueYesterday) / $revenueYesterday) * 100)
            : ($revenueToday > 0 ? 100 : 0);

        $orderDiff = $ordersToday - $ordersYesterday;

        $tables = CafeTable::ordered()->get();
        $activeTableCodes = Order::today()->active()->pluck('table_id')->unique();
        $occupiedCount = $tables->where(fn ($t) => $activeTableCodes->contains($t->code))->count();
        $totalTables = $tables->count();

        $lowStockCount = MenuItem::where('stock', '<=', config('cafe.low_stock_threshold', 5))->count();
        $menuPreview = MenuItem::ordered()->take(6)->get();

        $tablesWithStatus = $tables->map(fn ($t) => [
            'table' => $t,
            'occupied' => $activeTableCodes->contains($t->code),
        ]);

        return view('admin.dashboard', compact(
            'revenueToday',
            'revenuePct',
            'ordersToday',
            'orderDiff',
            'occupiedCount',
            'totalTables',
            'lowStockCount',
            'menuPreview',
            'tablesWithStatus',
        ));
    }
}
