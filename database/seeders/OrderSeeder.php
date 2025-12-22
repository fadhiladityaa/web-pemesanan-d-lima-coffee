<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Daftar_menu;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada user dummy
        $user = User::firstOrCreate(
            ['noHp' => '081234567890'],
            [
                'name' => 'Customer Dummy',
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
        );

        // Pastikan ada beberapa menu
        $menus = Daftar_menu::all();
        if ($menus->isEmpty()) {
            // Buat menu dummy jika belum ada
            $menus = Daftar_menu::factory()->count(10)->create();
        }

        // Generate order untuk beberapa bulan terakhir
        $months = [
            now()->subMonths(2), // 2 bulan lalu
            now()->subMonth(),   // 1 bulan lalu
            now(),               // bulan ini
        ];

        foreach ($months as $monthDate) {
            // Buat 5-10 order per bulan
            for ($i = 0; $i < rand(5, 10); $i++) {
                $orderDate = $monthDate->copy()
                    ->startOfMonth()
                    ->addDays(rand(0, 27))
                    ->setTime(rand(8, 20), rand(0, 59));

                $order = Order::create([
                    'user_id' => $user->id,
                    'alamat' => 'Jl. Dummy No.' . rand(1, 100),
                    'no_hp' => '08' . rand(100000000, 999999999),
                    'metode_pembayaran' => ['Cash', 'Bank Transfer', 'E-Wallet'][rand(0, 2)],
                    'payment_status' => 'paid',
                    'order_status' => ['proses', 'siap', 'selesai'][rand(0, 2)],
                    'total' => 0, // Akan diupdate nanti
                    'uang_dibayar' => null,
                    'kembalian' => null,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);

                // Tambah 1-4 item per order
                $orderTotal = 0;
                $selectedMenus = $menus->random(rand(1, 4));

                foreach ($selectedMenus as $menu) {
                    $quantity = rand(1, 3);
                    $price = $menu->harga;
                    $subTotal = $quantity * $price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'daftar_menu_id' => $menu->id,
                        'quantity' => $quantity,
                        'harga' => $price,
                        'sub_total' => $subTotal,
                        'created_at' => $orderDate,
                        'updated_at' => $orderDate,
                    ]);

                    $orderTotal += $subTotal;
                }

                // Update total order
                $order->update(['total' => $orderTotal]);

                // Jika metode pembayaran cash, set uang_dibayar dan kembalian
                if ($order->metode_pembayaran === 'Cash') {
                    $uangDibayar = $orderTotal + rand(1000, 10000); // Bayar lebih
                    $order->update([
                        'uang_dibayar' => $uangDibayar,
                        'kembalian' => $uangDibayar - $orderTotal
                    ]);
                }
            }
        }

        $this->command->info('✅ Data dummy orders berhasil dibuat!');
        $this->command->info('   - Total Orders: ' . Order::count());
        $this->command->info('   - Total Order Items: ' . OrderItem::count());
    }
}
