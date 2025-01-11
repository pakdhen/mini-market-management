<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Stats Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Selamat datang, {{ $userName }}!</p>
                </div>
            </div>

            @unless(auth()->user()->hasRole('Owner'))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Nama Cabang</h3>
                        <p class="text-2xl font-bold">{{ $branchName }}</p>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Lokasi</h3>
                        <p class="text-2xl font-bold">{{ $branchAddress }}</p>
                    </div>
                </div>
            </div>
            @endunless

            @role('Owner')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <!-- Card 1: Total Branches -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Cabang</h3>
                        <p class="text-3xl font-bold">{{ $totalBranches }}</p>
                    </div>
                </div>
                
                <!-- Card 2: Total Products -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Produk</h3>
                        <p class="text-3xl font-bold">{{$totalProducts }}</p>
                    </div>
                </div>
                
                <!-- Card 3: Total Stock -->
                {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Stok</h3>
                        <p class="text-3xl font-bold">{{ $totalStock }}</p>
                    </div>
                </div> --}}

                <!-- Card 4: Total Sales -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Penjualan</h3>
                        <p class="text-3xl font-bold">Rp{{ number_format($totalSales, 2, ',', '.') }}</p>
                    </div>
                </div>
                
            </div>

            {{-- <!-- Sales Overview Graph -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Penjualan per Bulan</h3>
                    <canvas id="salesChart" width="400" height="200"></canvas>
                </div>
            </div> --}}

            <!-- Stock by Product Chart -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Penjualan per Cabang</h3>
                    <canvas id="salesByBranchChart" width="150" height="65"></canvas>
                </div>
            </div>

            <!-- Recent Transactions Section -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Transaksi Terbaru</h3>
                    <table class="min-w-full text-sm text-gray-900">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Nama Kasir</th>
                                <th class="px-4 py-2 text-left">Tanggal & Waktu</th>
                                <th class="px-4 py-2 text-left">Cabang</th>
                                <th class="px-4 py-2 text-left">Produk</th>
                                <th class="px-4 py-2 text-left">Kuantitas</th>
                                <th class="px-4 py-2 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentTransactions as $transaction)
                                @foreach ($transaction->details as $detail)
                                    <tr>
                                        {{-- <td class="px-4 py-2 text-left">{{ $loop->parent->iteration }}</td> --}}
                                        <td class="px-4 py-2 text-left">{{ $transaction->user->name }}</td>
                                        <td class="px-4 py-2 text-left">{{ $transaction->transaction_date->format('d-m-Y H:i') }}</td>
                                        <td class="px-4 py-2 text-left">{{ $transaction->branch->name }}</td>
                                        <td class="px-4 py-2 text-left">{{ $detail->product->name }}</td>
                                        <td class="px-4 py-2 text-left">{{ $detail->quantity }}</td>
                                        <td class="px-4 py-2 text-left">Rp{{ number_format($transaction->total_price, 2, ',', '.') }}</td>
                                        {{-- <td class="px-4 py-2 text-left">Rp. {{ number_format($detail->price * $detail->quantity, 2, ',', '.') }}</td> --}}
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endrole
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesByBranchData = @json($salesByBranchData);
        const ctx = document.getElementById('salesByBranchChart').getContext('2d');
        const salesByBranchChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(salesByBranchData),
                datasets: [{
                    label: 'Total Penjualan',
                    data: Object.values(salesByBranchData),
                    backgroundColor: 'rgba(104, 117, 245, 0.2)',
                    borderColor: 'rgba(104, 117, 245, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>