<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('stocks.store') }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        <div class="max-w-xl">
                            <x-input-label for="product_id" value="Nama Produk" />
                            <select name="product_id" id="product_id" class="mt-1 block w-full" required>
                                <option value="" disabled selected>----------</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            {{-- <x-text-input id="product_id" type="text" name="product_id" class="mt-1 block w-full"
                                value="{{ old('product_id') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('product_id')" /> --}}
                        </div>
                        {{-- <div class="max-w-xl">
                            <x-input-label for="branch_id" value="ID Branch" />
                            <x-text-input id="branch_id" type="text" name="branch_id" class="mt-1 block w-full"
                                value="{{ old('branch_id') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('branch_id')" />
                        </div> --}}
                        <div class="max-w-xl">
                            <x-input-label for="quantity" value="Kuantitas" />
                            <x-text-input id="quantity" type="text" name="quantity" class="mt-1 block w-full"
                                value="{{ old('quantity') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                        </div>
                        <x-secondary-button tag="a" href="{{ route('stocks') }}">Cancel</x-secondary-button>
                        <x-primary-button name="save_and_create" value="true">Save & Create Another</x-primary-button>
                        <x-primary-button name="save" value="true">Save</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>