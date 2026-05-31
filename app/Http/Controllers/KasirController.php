<?php

namespace App\Http\Controllers;

use App\Models\CafeTable;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KasirController extends Controller
{
    public function dashboard(): View
    {
        $baruMasuk = Order::where('status', 'Baru')->orderBy('created_at')->get();
        $dimasak = Order::where('status', 'Diproses')->orderBy('created_at')->get();
        $siapBayar = Order::where('status', 'SiapBayar')->orderBy('created_at')->get();

        $stats = [
            'menunggu' => $baruMasuk->count(),
            'diproses' => $dimasak->count(),
            'selesai' => Order::today()->where('status', 'Selesai')->count(),
            'siap_bayar' => $siapBayar->count(),
            'omzet' => Order::revenueToday(),
        ];

        return view('kasir.dashboard', compact('baruMasuk', 'dimasak', 'siapBayar', 'stats'));
    }

    public function qrCodes(): View
    {
        $tables = CafeTable::active()->ordered()->get();

        return view('kasir.qr', compact('tables'));
    }

    public function terima(Order $order): RedirectResponse
    {
        $this->guardStatus($order, 'Baru');
        $order->update(['status' => 'Diproses']);

        return back()->with('success', 'Pesanan diterima — dimasak.');
    }

    public function tolak(Order $order): RedirectResponse
    {
        $this->guardStatus($order, 'Baru');
        $order->update(['status' => 'Batal']);

        return back()->with('success', 'Pesanan ditolak.');
    }

    public function tandaiSiap(Order $order): RedirectResponse
    {
        $this->guardStatus($order, 'Diproses');
        $order->update(['status' => 'SiapBayar']);

        return back()->with('success', 'Pesanan siap dibayar.');
    }

    public function bayar(Request $request, Order $order): RedirectResponse
    {
        $this->guardStatus($order, 'SiapBayar');

        $request->validate([
            'payment_method' => 'required|in:cash,qris',
        ]);

        $order->update([
            'status' => 'Selesai',
            'payment_method' => $request->payment_method,
        ]);

        return back()->with('success', 'Pembayaran berhasil ('.strtoupper($request->payment_method).').');
    }

    private function guardStatus(Order $order, string $expected): void
    {
        if ($order->status !== $expected) {
            abort(422, 'Status pesanan tidak valid.');
        }
    }
}
