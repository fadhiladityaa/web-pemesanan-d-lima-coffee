<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Daftar_menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;

class DashboardAdmin extends Component
{
    public $selectedMonth;
    public $selectedYear;
    public $months = [];
    public $years = [];

    public function mount()
    {
        // Set default ke bulan dan tahun saat ini
        $this->selectedMonth = date('m');
        $this->selectedYear = date('Y');

        // Generate pilihan bulan (1-12)
        $this->months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        // Generate pilihan tahun (2 tahun terakhir + tahun ini)
        $this->years = range(now()->year - 4, now()->year);
    }

    // Total Menu (tidak terpengaruh bulan)
    public function getTotalMenuProperty()
    {
        return Daftar_menu::count();
    }

    // Pendapatan Bulan Terpilih
    public function getMonthlyRevenueProperty()
    {
        return Order::where('payment_status', 'paid')
            ->whereMonth('created_at', $this->selectedMonth)
            ->whereYear('created_at', $this->selectedYear)
            ->sum('total');
    }

    // Total Pesanan Bulan Terpilih
    public function getMonthlyOrdersProperty()
    {
        return Order::whereMonth('created_at', $this->selectedMonth)
            ->whereYear('created_at', $this->selectedYear)
            ->count();
    }

    public function getConversionRateProperty()
    {
        if ($this->monthlyOrders <= 0) {
            return 0;
        }

        $paidOrders = Order::whereMonth('created_at', $this->selectedMonth)
            ->whereYear('created_at', $this->selectedYear)
            ->where('payment_status', 'paid')
            ->count();

        return round(($paidOrders / $this->monthlyOrders) * 100);
    }

    // Menu Terlaris Bulan Terpilih untuk Chart
    public function getTopMenusProperty()
    {
        return OrderItem::selectRaw('
                daftar_menu_id, 
                SUM(quantity) as total_terjual,
                daftar_menus.nama_menu as nama_menu,
                daftar_menus.harga as harga
            ')
            ->join('daftar_menus', 'order_items.daftar_menu_id', '=', 'daftar_menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.payment_status', 'paid')
            ->whereMonth('orders.created_at', $this->selectedMonth)
            ->whereYear('orders.created_at', $this->selectedYear)
            ->groupBy('daftar_menu_id', 'daftar_menus.nama_menu', 'daftar_menus.harga')
            ->orderByDesc('total_terjual')
            ->limit(10)
            ->get();
    }

    // Order Terbaru (5 terbaru)
    public function getRecentOrdersProperty()
    {
        return Order::with(['user', 'order_items.daftar_menu'])
            ->latest()
            ->limit(5)
            ->get();
    }

    // Data untuk Chart (format untuk Chart.js)
    public function getChartDataProperty()
    {
        $topMenus = $this->topMenus;

        $labels = $topMenus->pluck('nama_menu')->toArray();
        $data = $topMenus->pluck('total_terjual')->toArray();
        $backgroundColors = [
            '#3B82F6',
            '#10B981',
            '#F59E0B',
            '#EF4444',
            '#8B5CF6',
            '#06B6D4',
            '#84CC16',
            '#F97316',
            '#EC4899',
            '#6366F1'
        ];

        return [
            'labels' => $labels,
            'datasets' => [[
                'label' => 'Jumlah Terjual',
                'data' => $data,
                'backgroundColor' => array_slice($backgroundColors, 0, count($data)),
                'borderColor' => '#1F2937',
                'borderWidth' => 1
            ]]
        ];
    }

    // Tambah method untuk handle bulan/tahun change
    public function updatedSelectedMonth()
    {
        $this->dispatch('chart-data-updated');
    }

    public function updatedSelectedYear()
    {
        $this->dispatch('chart-data-updated');
    }

    // Format bulan dan tahun untuk display
    public function getSelectedPeriodProperty()
    {
        return $this->months[$this->selectedMonth] . ' ' . $this->selectedYear;
    }

    // Total Customer (All time)
    public function getTotalCustomersProperty()
    {
        return User::where('role', 'user')->count();
    }

    #[Layout('layouts.admin')]
    #[Title('Dashboard Admin')]
    public function render()
    {
        return view('livewire.dashboard-admin', [
            'totalMenu' => $this->totalMenu,
            'monthlyRevenue' => $this->monthlyRevenue,
            'monthlyOrders' => $this->monthlyOrders,
            'totalCustomers' => $this->totalCustomers,
            'topMenus' => $this->topMenus,
            'recentOrders' => $this->recentOrders,
            'chartData' => $this->chartData,
            'selectedPeriod' => $this->selectedPeriod,
        ]);
    }
}
