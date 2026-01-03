<div>
    <!-- Header dengan Filter -->
    <div class="mb-6 flex flex-col mt-20 p-7 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600 mt-1">Statistik dan analisis penjualan</p>
        </div>

        <div class="mt-4 sm:mt-0 flex items-center space-x-3">
            <!-- Filter Bulan -->
            <div class="flex items-center space-x-2">
                <select wire:model.live="selectedMonth"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white shadow-sm">
                    @foreach ($months as $key => $month)
                        <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>

                <select wire:model.live="selectedYear"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white shadow-sm">
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div
                class="text-sm text-gray-600 bg-gradient-to-r from-primary/10 to-primary/5 px-3 py-1.5 rounded-lg border border-primary/20">
                Periode: <span class="font-semibold text-primary">{{ $selectedPeriod }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 mx-5 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Menu -->
        <div
            class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-blue-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Menu</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalMenu) }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                            <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Semua kategori
                        </span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-blue-100 to-blue-50 text-blue-600 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pendapatan Bulan Ini -->
        <div
            class="bg-gradient-to-br from-white to-green-50 rounded-xl shadow-sm border border-green-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pendapatan {{ $selectedPeriod }}</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">Rp
                        {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                            @if ($monthlyRevenue > 0)
                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ number_format($monthlyRevenue / 1000000, 1) }}Jt
                            @else
                                Belum ada pendapatan
                            @endif
                        </span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-green-100 to-green-50 text-green-600 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div
            class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-sm border border-amber-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Pesanan {{ $selectedPeriod }}</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($monthlyOrders) }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded-full">
                            @if ($monthlyOrders > 0)
                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ round($monthlyOrders / 30) }}/hari
                            @else
                                Belum ada pesanan
                            @endif
                        </span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-amber-100 to-amber-50 text-amber-600 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Customer -->
        <div
            class="bg-gradient-to-br from-white to-purple-50 rounded-xl shadow-sm border border-purple-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Customer</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalCustomers) }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded-full">
                            <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Aktif: {{ $recentOrders->count() > 0 ? $recentOrders->unique('user_id')->count() : 0 }}
                        </span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-purple-100 to-purple-50 text-purple-600 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="grid grid-cols-1 mx-5 lg:grid-cols-3 gap-6 mb-8">
        <!-- Chart Container -->
        <div
            class="lg:col-span-2 bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">🔥 10 Menu Terlaris {{ $selectedPeriod }}</h2>
                    <p class="text-sm text-gray-600 mt-1">Visualisasi data penjualan berdasarkan jumlah item terjual</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1.5 rounded-lg">
                        Total: <span class="font-semibold text-primary">{{ $topMenus->sum('total_terjual') }}
                            item</span>
                    </div>
                    <button onclick="exportChart()"
                        class="text-sm text-gray-600 hover:text-primary border border-gray-300 hover:border-primary px-3 py-1.5 rounded-lg transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export
                    </button>
                </div>
            </div>

            <!-- Chart Canvas -->
            <div class="relative h-80">
                <canvas id="topMenusChart" wire:ignore></canvas>
                <div id="chartLoading" class="absolute inset-0 bg-white/80 flex items-center justify-center hidden">
                    <div class="text-center">
                        <div
                            class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-primary">
                        </div>
                        <p class="mt-2 text-gray-600">Memuat data...</p>
                    </div>
                </div>
            </div>

            <!-- Legend dengan hover effect -->
            @if ($topMenus->isNotEmpty())
                <div class="mt-8 grid grid-cols-2 md:grid-cols-5 gap-3">
                    @foreach ($topMenus as $index => $menu)
                        <div class="legend-item flex items-center p-2 rounded-lg hover:bg-gray-50 transition-all duration-200 cursor-pointer group"
                            onmouseover="highlightBar({{ $index }})" onmouseout="resetChart()">
                            <div class="w-4 h-4 rounded-full mr-3 transition-transform duration-200 group-hover:scale-125"
                                style="background: linear-gradient(135deg, {{ [
                                    '#667eea',
                                    '#764ba2',
                                    '#f093fb',
                                    '#f5576c',
                                    '#fe8c00',
                                    '#f83600',
                                    '#4facfe',
                                    '#00f2fe',
                                    '#43e97b',
                                    '#38f9d7',
                                ][$index] }}, {{ [
                                    '#764ba2',
                                    '#667eea',
                                    '#f5576c',
                                    '#f093fb',
                                    '#f83600',
                                    '#fe8c00',
                                    '#00f2fe',
                                    '#4facfe',
                                    '#38f9d7',
                                    '#43e97b',
                                ][$index] }})">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate group-hover:text-primary transition-colors"
                                    title="{{ $menu->nama_menu }}">
                                    {{ Str::limit($menu->nama_menu, 18) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    {{ $menu->total_terjual }} terjual •
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-gray-100 to-gray-200 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <p class="text-gray-500">📊 Belum ada data penjualan untuk periode ini</p>
                    <p class="text-sm text-gray-400 mt-1">Coba pilih bulan lain atau tunggu pesanan masuk</p>
                </div>
            @endif
        </div>

        <!-- Order Terbaru -->
        <div
            class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-300 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">📦 Pesanan Terbaru</h2>
                    <span class="text-xs font-medium px-2 py-1 rounded-full bg-primary/10 text-primary">
                        {{ $recentOrders->count() }} baru
                    </span>
                </div>
            </div>
            <div class="divide-y divide-gray-200 max-h-[400px] overflow-y-auto">
                @forelse($recentOrders as $order)
                    <div
                        class="p-4 hover:bg-gradient-to-r hover:from-primary/5 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-start">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-r from-primary/20 to-primary/10 flex items-center justify-center text-primary font-bold text-sm group-hover:scale-110 transition-transform duration-300">
                                        {{ substr($order->user->name ?? 'Unknown', 0, 1) }}
                                    </div>
                                    @if ($order->payment_status === 'paid')
                                        <div
                                            class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-semibold text-gray-800 group-hover:text-primary transition-colors">
                                        {{ $order->user->name ?? 'User Terhapus' }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $order->no_hp }}</p>
                                </div>
                            </div>
                            <span
                                class="text-xs px-2.5 py-1 rounded-full font-medium 
                                @if ($order->order_status == 'selesai') bg-gradient-to-r from-green-100 to-green-50 text-green-700 border border-green-200
                                @elseif($order->order_status == 'proses') bg-gradient-to-r from-blue-100 to-blue-50 text-blue-700 border border-blue-200
                                @elseif($order->order_status == 'siap') bg-gradient-to-r from-amber-100 to-amber-50 text-amber-700 border border-amber-200
                                @else bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 border border-gray-200 @endif">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600 mb-3 line-clamp-2">
                            📍 {{ Str::limit($order->alamat, 45) }}
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="text-xs px-2 py-1 bg-gray-100 rounded-full text-gray-700">
                                    {{ $order->order_items->count() }} item
                                </span>
                                <span class="text-xs px-2 py-1 bg-gray-100 rounded-full text-gray-700">
                                    {{ $order->metode_pembayaran }}
                                </span>
                            </div>
                            <span class="font-bold text-primary text-sm">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 mt-3 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $order->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-gray-100 to-gray-200 mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-gray-500">Belum ada pesanan terbaru</p>
                    </div>
                @endforelse
            </div>
            @if ($recentOrders->isNotEmpty())
                <div class="p-4 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <a href="{{ route('dashboard.pesanan.masuk') }}"
                        class="text-sm font-medium text-primary hover:text-primary/80 flex items-center justify-center group">
                        Lihat semua pesanan
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Stats dengan efek glassmorphism -->
    @if ($topMenus->isNotEmpty())
        <div class="mt-8 p-6 rounded-2xl mx-5 mb-5 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
            <h2 class="text-xl font-bold mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                        clip-rule="evenodd" />
                </svg>
                💎 Performa Penjualan
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div
                    class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-300">Menu Terlaris</p>
                            <p class="text-lg font-bold mt-1 truncate" title="{{ $topMenus->first()->nama_menu }}">
                                {{ Str::limit($topMenus->first()->nama_menu, 20) }}
                            </p>
                        </div>
                        <div class="text-amber-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-300">Terjual</span>
                            <span class="font-semibold text-green-400">{{ $topMenus->first()->total_terjual }}
                                item</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                            <div class="bg-gradient-to-r from-amber-500 to-amber-400 h-2 rounded-full"
                                style="width: {{ min(100, ($topMenus->first()->total_terjual / max(1, $topMenus->sum('total_terjual'))) * 100) }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-300">Rata-rata Transaksi</p>
                            <p class="text-lg font-bold mt-1">
                                Rp
                                {{ number_format($monthlyOrders > 0 ? $monthlyRevenue / $monthlyOrders : 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-green-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm2.5 3a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm6.207.293a1 1 0 00-1.414 0l-6 6a1 1 0 101.414 1.414l6-6a1 1 0 000-1.414zM12.5 10a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">per pesanan</p>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-300">Item per Pesanan</p>
                            <p class="text-lg font-bold mt-1">
                                {{ $recentOrders->isNotEmpty()
                                    ? number_format($recentOrders->flatMap->order_items->sum('quantity') / $recentOrders->count(), 1)
                                    : 0 }}
                            </p>
                        </div>
                        <div class="text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">rata-rata item</p>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-300">Konversi Pembayaran</p>
                            <p class="text-lg font-bold mt-1">
                                {{ $this->conversionRate }}%
                            </p>
                        </div>
                        <div class="text-purple-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">paid vs pending</p>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            let chart = null;
            let highlightedIndex = -1;

            // Palette warna yang SANGAT KONTRAST dan PASTI KELIHATAN
            const colorPalette = [
                '#FF6B6B', // MERAH TERANG
                '#4ECDC4', // TEAL TERANG  
                '#FFD166', // KUNING TERANG
                '#06D6A0', // HIJAU TERANG
                '#118AB2', // BIRU LAUT
                '#EF476F', // PINK TERANG
                '#073B4C', // BIRU TUA
                '#7209B7', // UNGU TERANG
                '#F3722C', // ORANGE TERANG
                '#577590' // BIRU ABU-ABU
            ];

            const hoverColorPalette = [
                '#FF4757', // MERAH LEBIH GELAP
                '#00CEC9', // TEAL LEBIH GELAP
                '#FFC145', // KUNING LEBIH GELAP
                '#00B894', // HIJAU LEBIH GELAP
                '#0A74A6', // BIRU LEBIH GELAP
                '#FD3A69', // PINK LEBIH GELAP
                '#052D3D', // BIRU TUA LEBIH GELAP
                '#5A009D', // UNGU LEBIH GELAP
                '#E65C19', // ORANGE LEBIH GELAP
                '#4A6381' // BIRU ABU-ABU LEBIH GELAP
            ];

            const initChart = () => {
                const ctx = document.getElementById('topMenusChart').getContext('2d');
                const loadingEl = document.getElementById('chartLoading');

                if (loadingEl) loadingEl.classList.remove('hidden');

                setTimeout(() => {
                    if (chart) {
                        chart.destroy();
                    }

                    const chartData = @js($chartData);

                    if (chartData.labels.length === 0) {
                        // Show message if no data
                        ctx.font = '16px "Inter", sans-serif';
                        ctx.fillStyle = '#6B7280';
                        ctx.textAlign = 'center';
                        ctx.fillText('📊 Tidak ada data untuk ditampilkan',
                            ctx.canvas.width / 2,
                            ctx.canvas.height / 2);
                        if (loadingEl) loadingEl.classList.add('hidden');
                        return;
                    }

                    // Update colors dengan gradient yang KONTRAST
                    chartData.datasets[0].backgroundColor = colorPalette.slice(0, chartData.labels
                        .length);
                    chartData.datasets[0].hoverBackgroundColor = hoverColorPalette.slice(0, chartData
                        .labels.length);
                    chartData.datasets[0].borderWidth = 2;
                    chartData.datasets[0].borderColor =
                        'rgba(255, 255, 255, 0.9)'; // Border putih untuk kontras
                    chartData.datasets[0].borderRadius = 10; // Sudut lebih bulat
                    chartData.datasets[0].borderSkipped = false;
                    chartData.datasets[0].barPercentage = 0.7; // Lebar bar 70%
                    chartData.datasets[0].categoryPercentage = 0.8; // Spasi antar bar

                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: chartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 1000,
                                easing: 'easeOutQuart'
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(15, 23, 42, 0.9)', // Dark blue background
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    titleFont: {
                                        family: "'Inter', sans-serif",
                                        size: 13,
                                        weight: '600'
                                    },
                                    bodyFont: {
                                        family: "'Inter', sans-serif",
                                        size: 12
                                    },
                                    padding: 12,
                                    cornerRadius: 8,
                                    displayColors: true,
                                    boxPadding: 5,
                                    callbacks: {
                                        label: function(context) {
                                            const value = context.raw;
                                            const menuName = chartData.labels[context
                                                .dataIndex];
                                            return [
                                                `📦 ${menuName}`,
                                                `🛒 Terjual: ${value} item`,
                                                `🏆 Peringkat: #${context.dataIndex + 1}`
                                            ];
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.08)',
                                        drawBorder: false,
                                        lineWidth: 1
                                    },
                                    ticks: {
                                        color: '#6B7280',
                                        font: {
                                            family: "'Inter', sans-serif",
                                            size: 11,
                                            weight: '500'
                                        },
                                        stepSize: 1,
                                        padding: 8
                                    },
                                    title: {
                                        display: true,
                                        text: 'Jumlah Terjual (item)',
                                        color: '#374151',
                                        font: {
                                            family: "'Inter', sans-serif",
                                            size: 13,
                                            weight: '600'
                                        },
                                        padding: {
                                            top: 10,
                                            bottom: 20
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#4B5563',
                                        font: {
                                            family: "'Inter', sans-serif",
                                            size: 11,
                                            weight: '500'
                                        },
                                        maxRotation: 45,
                                        minRotation: 45,
                                        padding: 10
                                    },
                                    title: {
                                        display: true,
                                        text: 'Nama Menu',
                                        color: '#374151',
                                        font: {
                                            family: "'Inter', sans-serif",
                                            size: 13,
                                            weight: '600'
                                        },
                                        padding: {
                                            top: 20,
                                            bottom: 10
                                        }
                                    }
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            },
                            onHover: (event, chartElement) => {
                                if (chartElement.length) {
                                    event.native.target.style.cursor = 'pointer';
                                } else {
                                    event.native.target.style.cursor = 'default';
                                }
                            },
                            onClick: (event, chartElement) => {
                                if (chartElement.length) {
                                    const index = chartElement[0].index;
                                    const menuName = chartData.labels[index];
                                    const quantity = chartData.datasets[0].data[index];

                                    // Bisa diganti dengan modal atau action lain
                                    Livewire.dispatch('show-menu-detail', {
                                        menuId: index
                                    });
                                }
                            }
                        }
                    });

                    if (loadingEl) loadingEl.classList.add('hidden');
                }, 300);
            };


            // Function untuk highlight bar
            window.highlightBar = function(index) {
                if (chart) {
                    chart.setActiveElements([{
                        datasetIndex: 0,
                        index
                    }]);
                    chart.update();
                    highlightedIndex = index;
                }
            };

            // Function untuk reset chart
            window.resetChart = function() {
                if (chart && highlightedIndex !== -1) {
                    chart.setActiveElements([]);
                    chart.update();
                    highlightedIndex = -1;
                }
            };

            // Function untuk export chart
            window.exportChart = function() {
                if (!chart) return;

                const canvas = document.getElementById('topMenusChart');
                const link = document.createElement('a');
                link.download = `chart-menu-terlaris-${@js($selectedPeriod)}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
            };

            // Initial chart render
            initChart();

            // Update chart when month/year changes
            Livewire.on('chart-updated', () => {
                initChart();
            });

            // Debounce untuk update chart
            let chartUpdateTimeout;
            Livewire.on('chart-data-updated', () => {
                clearTimeout(chartUpdateTimeout);
                chartUpdateTimeout = setTimeout(initChart, 300);
            });

            // Listen untuk perubahan Livewire
            document.addEventListener('livewire:navigated', () => {
                setTimeout(initChart, 500);
            });
        });
    </script>

    <!-- Tambahkan style untuk efek hover dan animasi -->
    <style>
        .legend-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Animasi untuk stats cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stats-card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Efek glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        /* Hover effect untuk chart bars */
        .chart-bar-hover {
            transition: all 0.3s ease;
        }

        .chart-bar-hover:hover {
            filter: brightness(1.1);
            transform: scale(1.02);
        }
    </style>
@endpush
