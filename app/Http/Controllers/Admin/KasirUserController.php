<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KasirUserController extends Controller
{
    public function index(): View
    {
        $kasirs = User::where('role', 'kasir')->orderBy('name')->get();

        return view('admin.kasir.index', compact('kasirs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'kasir',
            'email_verified_at' => now(),
        ]);

        return back()
            ->with('success', 'Kasir berhasil didaftarkan.')
            ->with('kasir_created', [
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            abort(403);
        }

        $user->delete();

        return back()->with('success', 'Akun kasir dihapus.');
    }
}
