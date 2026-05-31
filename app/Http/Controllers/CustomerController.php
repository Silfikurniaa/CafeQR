<?php

namespace App\Http\Controllers;

use App\Models\CafeTable;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function menu(string $table): View
    {
        $table = strtoupper(trim($table));

        if (! $this->isValidTable($table)) {
            abort(404, 'Meja tidak ditemukan. Silakan scan QR code di meja Anda.');
        }

        $menuItems = MenuItem::active()->ordered()->get()->map->toMenuArray()->all();
        $filter    = request('filter', 'Semua');
        $filtered  = $filter === 'Semua'
            ? $menuItems
            : array_values(array_filter($menuItems, fn ($i) => $i['category'] === $filter));

        return view('customer.menu', compact('table', 'menuItems', 'filtered', 'filter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|string',
            'items'    => 'required|array|min:1',
        ]);

        $tableId = strtoupper(trim($request->table_id));

        if (! $this->isValidTable($tableId)) {
            return back()->withErrors(['table_id' => 'Meja tidak valid.']);
        }

        Order::create([
            'table_id' => $tableId,
            'items'    => $request->items,
        ]);

        return redirect()->route('customer.success', ['table' => $tableId]);
    }

    public function success(string $table): View
    {
        $table = strtoupper(trim($table));

        return view('customer.success', compact('table'));
    }

    private function isValidTable(string $table): bool
    {
        return CafeTable::active()->where('code', $table)->exists();
    }
}
