<!-- filepath: /D:/Semester 5/PWL/mini-market-management/resources/views/branches/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Cabang: ' . $branch->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-2">Alamat</h3>
                    <p class="text-lg">{{ $branch->address }}</p>

                    <div class="mt-6">
                        <nav class="flex space-x-4">
                            <button onclick="showTab('stocks')" class="text-gray-500 hover:text-gray-700">Stok Produk</button>
                            <button onclick="showTab('transactions')" class="text-gray-500 hover:text-gray-700">Transaksi</button>
                            <button onclick="showTab('employees')" class="text-gray-500 hover:text-gray-700">Pegawai</button>
                        </nav>
                    </div>

                    <div id="stocks" class="tab-content mt-6">
                        <h3 class="text-xl font-semibold mb-2">Stok Produk</h3>
                        <x-table>
                            <x-slot name="header">
                                <tr class="py-10">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </x-slot>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stock->product->name }}</td>
                                    <td>{{ $stock->product->price }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>
                                        <x-primary-button tag="a"
                                            href="{{ route('stocks.edit', $stock->id) }}">Edit</x-primary-button>
                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-stock-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('stocks.destroy', $stock->id) }}')">{{ __('Delete') }}</x-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        </x-table>
                    </div>

                    <div id="transactions" class="tab-content mt-6 hidden">
                        <h3 class="text-xl font-semibold mb-2">Transaksi</h3>
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="py-2">Nama Kasir</th>
                                    <th class="py-2">Tanggal</th>
                                    <th class="py-2">Produk</th>
                                    <th class="py-2">Kuantitas</th>
                                    <th class="py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    @foreach ($transaction->details as $detail)
                                        <tr>
                                            <td class="py-2">{{ $transaction->user->name }}</td>
                                            <td class="py-2">{{ $transaction->created_at }}</td>
                                            <td class="py-2">{{ $detail->product->name }}</td>
                                            <td class="py-2">{{ $detail->quantity }}</td>
                                            <td class="py-2">{{ $transaction->total_price }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="employees" class="tab-content mt-6 hidden">
                        <h3 class="text-xl font-semibold mb-2">Pegawai</h3>
                        {{-- <x-primary-button tag="a" href="{{ route('users.create') }}">Tambah Pegawai</x-primary-button> --}}
                        <x-table>
                            <x-slot name="header">
                                <tr class="py-10">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </x-slot>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>
                                        {{-- <x-primary-button tag="a" href="{{ route('users.edit', $employee->id) }}">Edit</x-primary-button> --}}
                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('users.destroy', $employee->id) }}')">{{ __('Delete') }}</x-danger-button>
                                    </td>
                                   
                                </tr>
                            @endforeach
                        </x-table>

                        <x-modal name="confirm-user-deletion" focusable maxWidth="xl">
                            <form method="post" x-bind:action="action" class="p-6">
                                @method('delete')
                                @csrf
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Apakah anda yakin akan menghapus data?') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                                </p>
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                                    <x-danger-button class="ml-3">
                                        {{ __('Delete!!!') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.classList.add('hidden');
            });

            // Show the selected tab content
            document.getElementById(tabId).classList.remove('hidden');
        }
    </script>
</x-app-layout>