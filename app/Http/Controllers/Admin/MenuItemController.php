<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    public function index(): View
    {
        $items = MenuItem::ordered()->get();

        return view('admin.menu.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.menu.form', ['item' => new MenuItem]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['sort_order'] = (MenuItem::max('sort_order') ?? 0) + 1;
        $data['is_active'] = true;

        MenuItem::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(MenuItem $menuItem): View
    {
        return view('admin.menu.form', ['item' => $menuItem]);
    }

    public function update(Request $request, MenuItem $menuItem): RedirectResponse
    {
        $menuItem->update($this->validated($request));

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function toggle(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->update(['is_active' => ! $menuItem->is_active]);

        return back()->with('success', 'Status menu diperbarui.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:Makanan,Minuman',
            'emoji' => 'nullable|string|max:16',
            'is_active' => 'sometimes|boolean',
        ], [], [
            'name' => 'nama menu',
            'price' => 'harga',
            'stock' => 'stok',
            'category' => 'kategori',
        ]);

        return $data + [
            'emoji' => $request->input('emoji') ?: '🍽️',
            'is_active' => $request->has('is_active') ? $request->boolean('is_active') : true,
        ];
    }
}
