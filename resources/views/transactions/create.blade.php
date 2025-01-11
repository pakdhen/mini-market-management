<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="user_id" :value="__('Nama Pengguna')" />
                            <select id="user_id" name="user_id" class="block mt-1 w-full" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="details" :value="__('Detail Produk')" />
                            <div id="product-details">
                                <div class="flex space-x-4">
                                    <select name="details[0][product_id]" class="block mt-1 w-full" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-text-input type="number" name="details[0][quantity]" class="block mt-1 w-full" placeholder="Kuantitas" required />
                                </div>
                            </div>
                            <x-primary-button type="button" class="mt-4" onclick="addProductDetail()">Tambah Produk</x-primary-button>
                        </div>
                        {{-- <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Tambah') }}
                            </x-primary-button>
                        </div> --}}
                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button tag="a" href="{{ route('transactions') }}">Cancel</x-secondary-button>
                            {{-- <x-primary-button name="save_and_create" value="true">Save & Create Another</x-primary-button> --}}
                            <x-primary-button name="save" value="true">Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let productDetailIndex = 1;

        function addProductDetail() {
            const productDetails = document.getElementById('product-details');
            const newDetail = document.createElement('div');
            newDetail.classList.add('flex', 'space-x-4', 'mt-4');
            newDetail.innerHTML = `
                <select name="details[${productDetailIndex}][product_id]" class="block mt-1 w-full" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <x-text-input type="number" name="details[${productDetailIndex}][quantity]" class="block mt-1 w-full" placeholder="Kuantitas" required />
            `;
            productDetails.appendChild(newDetail);
            productDetailIndex++;
        }
    </script>
</x-app-layout>