<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mini Market Dashboard - Bapak Jayusman') }}
        </h2>
    </x-slot>

    <!-- Stats Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1: Total Branches -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Branches</h3>
                        <p class="text-3xl font-bold">5</p>
                    </div>
                </div>

                <!-- Card 2: Total Sales -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Sales</h3>
                        <p class="text-3xl font-bold">$50,000</p>
                    </div>
                </div>

                <!-- Card 3: Total Stock -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Stock</h3>
                        <p class="text-3xl font-bold">2,000 Items</p>
                    </div>
                </div>
            </div>

            <!-- Sales Overview Graph -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Sales Overview by Month</h3>
                    <canvas id="salesChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Recent Transactions Section -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Recent Transactions</h3>
                    <table class="min-w-full text-sm text-gray-900">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Branch</th>
                                <th class="px-4 py-2 text-left">Product</th>
                                <th class="px-4 py-2 text-left">Quantity</th>
                                <th class="px-4 py-2 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2">2025-01-06</td>
                                <td class="px-4 py-2">Branch 1</td>
                                <td class="px-4 py-2">Product A</td>
                                <td class="px-4 py-2">10</td>
                                <td class="px-4 py-2">$100</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2">2025-01-05</td>
                                <td class="px-4 py-2">Branch 2</td>
                                <td class="px-4 py-2">Product B</td>
                                <td class="px-4 py-2">5</td>
                                <td class="px-4 py-2">$50</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April'],  // Bulan
                datasets: [{
                    label: 'Sales ($)',
                    data: [10000, 15000, 12000, 13000],  // Data Penjualan
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
