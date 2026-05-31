<?php

use App\Http\Controllers\Admin\CafeTableController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KasirUserController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Pelanggan — tanpa login (scan QR → menu)
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('customer.landing'))->name('home');

Route::get('/m/{table}', [CustomerController::class, 'menu'])->name('customer.menu');
Route::get('/menu/{table}', fn (string $table) => redirect()->route('customer.menu', $table));
Route::post('/orders', [CustomerController::class, 'store'])->name('orders.store');
Route::get('/sukses/{table}', [CustomerController::class, 'success'])->name('customer.success');

/*
|--------------------------------------------------------------------------
| Redirect setelah login (kompatibilitas)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return redirect(auth()->user()->homeRoute());
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Super Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/menu', [AdminMenuItemController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [AdminMenuItemController::class, 'create'])->name('menu.create');
    Route::post('/menu', [AdminMenuItemController::class, 'store'])->name('menu.store');
    Route::get('/menu/{menuItem}/edit', [AdminMenuItemController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{menuItem}', [AdminMenuItemController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menuItem}', [AdminMenuItemController::class, 'destroy'])->name('menu.destroy');
    Route::patch('/menu/{menuItem}/toggle', [AdminMenuItemController::class, 'toggle'])->name('menu.toggle');

    Route::get('/tables', [CafeTableController::class, 'index'])->name('tables.index');
    Route::post('/tables', [CafeTableController::class, 'store'])->name('tables.store');
    Route::delete('/tables/{cafeTable}', [CafeTableController::class, 'destroy'])->name('tables.destroy');
    Route::patch('/tables/{cafeTable}/toggle', [CafeTableController::class, 'toggle'])->name('tables.toggle');

    Route::get('/kasir', [KasirUserController::class, 'index'])->name('kasir.index');
    Route::post('/kasir', [KasirUserController::class, 'store'])->name('kasir.store');
    Route::delete('/kasir/{user}', [KasirUserController::class, 'destroy'])->name('kasir.destroy');

    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| Kasir
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [KasirController::class, 'dashboard'])->name('dashboard');
    Route::get('/qr', [KasirController::class, 'qrCodes'])->name('qr');
    Route::patch('/orders/{order}/terima', [KasirController::class, 'terima'])->name('orders.terima');
    Route::patch('/orders/{order}/tolak', [KasirController::class, 'tolak'])->name('orders.tolak');
    Route::patch('/orders/{order}/siap', [KasirController::class, 'tandaiSiap'])->name('orders.siap');
    Route::post('/orders/{order}/bayar', [KasirController::class, 'bayar'])->name('orders.bayar');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
