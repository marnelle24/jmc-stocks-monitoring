<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="col-span-2 bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-4 border-b border-gray-200 bg-white">
                    Products By Category
                </div>
                <div class="bg-gray-50 bg-opacity-25 border p-4 h-[400px]">
                    @livewire('chart.category-column-chart')
                </div>
            </div>   
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-2 bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 lg:p-8 border-b border-gray-200 bg-white">
                        <p class="font-bold text-lg">Summary</p>
                    </div>
                    <div class="bg-gray-50 bg-opacity-25 border p-6">
                    </div>
                </div>
                <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 lg:p-8 border-b border-gray-200 bg-white">
                        Column 2
                    </div>
                    <div class="bg-gray-50 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                        @dump(auth()->user()->getPermissionsViaRoles()[1])
                    </div>
                </div>
            </div>
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div> --}}
        </div>
    </div>
</x-app-layout>
