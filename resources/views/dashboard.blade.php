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
                        <p class="text-3xl font-bold">{{ $totalBranches }}</p>
                    </div>
                </div>

                <!-- Card 2: Total Sales -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Sales</h3>
                        <p class="text-3xl font-bold">${{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>

                <!-- Card 3: Total Stock -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Total Stock</h3>
                        <p class="text-3xl font-bold">{{ $totalStock }} Items</p>
                    </div>
                </div>
            </div>

            <!-- Recent Sales Section -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Recent Sales</h3>
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
                            @foreach ($recentSales as $sale)
                                <tr>
                                    <td class="px-4 py-2">{{ $sale->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2">{{ $sale->branch->name }}</td>
                                    <td class="px-4 py-2">{{ $sale->product->name }}</td>
                                    <td class="px-4 py-2">{{ $sale->quantity }}</td>
                                    <td class="px-4 py-2">${{ number_format($sale->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
