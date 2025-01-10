<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cabang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">No</th>
                                <th scope="col">Nama Cabang</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </x-slot>
                        @foreach ($branches as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->address }}</td>
                                   
                               
                            </tr>
                        @endforeach
                    </x-table>

                   

                </div>
            </div>
        </div>
    </div>
</x-app-layout>