<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CafeTableController extends Controller
{
    public function index(): View
    {
        $tables = CafeTable::ordered()->get();
        $activeCodes = \App\Models\Order::today()->active()->pluck('table_id')->unique();

        $tablesWithStatus = $tables->map(fn ($t) => [
            'table' => $t,
            'occupied' => $activeCodes->contains($t->code),
        ]);

        return view('admin.tables.index', compact('tablesWithStatus'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => 'required|string|max:16|unique:cafe_tables,code',
        ]);

        CafeTable::create([
            'code' => strtoupper(trim($data['code'])),
            'is_active' => true,
            'sort_order' => (CafeTable::max('sort_order') ?? 0) + 1,
        ]);

        return back()->with('success', 'Meja '.strtoupper($data['code']).' ditambahkan.');
    }

    public function destroy(CafeTable $cafeTable): RedirectResponse
    {
        $cafeTable->delete();

        return back()->with('success', 'Meja dihapus.');
    }

    public function toggle(CafeTable $cafeTable): RedirectResponse
    {
        $cafeTable->update(['is_active' => ! $cafeTable->is_active]);

        return back()->with('success', 'Status meja diperbarui.');
    }
}
