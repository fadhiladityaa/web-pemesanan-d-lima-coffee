<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get recent 5 orders for history
        $orders = Order::where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();

        // Get latest address from the last order
        $lastOrder = Order::where('user_id', $user->id)->latest()->first();
        $latestAddress = $lastOrder ? $lastOrder->alamat : null;

        return view('profil-pengguna', [
            'title' => 'Profil Anda',
            'user' => $user,
            'orders' => $orders,
            'latestAddress' => $latestAddress,
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'noHp' => 'required|string|max:15|unique:users,noHp,' . Auth::id(),
        ]);

        $user = Auth::user();

        /** @var \App\Models\User $user */
        $user->update([
            'name' => $request->name,
            'noHp' => $request->noHp,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini tidak sesuai.');
        }

        /** @var \App\Models\User $user */
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
