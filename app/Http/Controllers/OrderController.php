<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function printReceipt($id)
    {
        $order = Order::with('order_items.daftar_menu', 'user')->findOrFail($id);

        // Security check: ensure order belongs to logged in user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only allow printing if paid
        if ($order->payment_status !== 'paid') {
            return redirect()->back()->with('error', 'Order belum dibayar.');
        }

        $pdf = Pdf::loadView('pdf.receipt', compact('order'));
        
        // return $pdf->download('Receipt-' . $order->id . '.pdf'); // Force download
        return $pdf->stream('Receipt-' . $order->id . '.pdf'); // Open in browser
    }
}
