<?php

namespace App\Http\Controllers;

use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\order;
use App\Models;

class checkout extends Controller
{
    public function index() 
    {
        return view('checkout', [
            'title' => 'Halaman Checkout'
        ]);
    }

    public function store(Request $request) 
    {
        $cart = json_decode($request->menu, true);

        DB::transaction(function () use ($request) {
            
            $order = Order::create([
                'user_id' => auth()->id,
                'payment_status' => 'pending',
                'order_status' => 'proses',
                'metode_pembayaran' => null,
                'total' => '',
            ]);

        });

    }
}
