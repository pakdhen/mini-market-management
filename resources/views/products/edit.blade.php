<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"
                        class="mt-6 space-y6">
                        @method('PATCH')
                        @csrf
                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama Produk" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full"
                                value="{{ old('name', $product->name) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="price" value="Harga" />
                            <x-text-input id="price" type="text" name="price" class="mt-1 block w-full"
                                value="{{ old('price', $product->price) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>
                        <x-secondary-button tag="a" href="{{ route('products') }}">Cancel</x-secondary-button>
                        <x-primary-button value="true">Update</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>