<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderByDesc('created_at')
            ->get();

        $totalRevenue = $orders->sum(fn ($o) => $o->totalAmount());
        $totalOrders = $orders->count();

        $byDay = $orders->groupBy(fn ($o) => $o->created_at->format('Y-m-d'))
            ->map(fn ($dayOrders, $date) => [
                'date' => $date,
                'count' => $dayOrders->count(),
                'revenue' => $dayOrders->sum(fn ($o) => $o->totalAmount()),
            ])
            ->sortKeysDesc()
            ->values();

        return view('admin.reports.index', compact('orders', 'totalRevenue', 'totalOrders', 'byDay'));
    }
}
