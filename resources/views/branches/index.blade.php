<!-- filepath: /D:/Semester 5/PWL/mini-market-management/resources/views/branches/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cabang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach ($branches as $branch)
                    <a href="{{ route('branches.show', $branch->id) }}" class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $branch->name }}</h3>
                            <p class="text-lg">{{ $branch->address }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>