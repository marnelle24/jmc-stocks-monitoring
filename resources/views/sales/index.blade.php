@section('title', 'Sales')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Revenue Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-2 mb-8 gap-8 xl:px-0 sm:px-4">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3 lg:p-5 border-b border-gray-200">
                    test 1
                </div>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3 lg:p-5 border-b border-gray-200">
                    test 2
                </div>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3 lg:p-5 border-b border-gray-200">
                    test 3
                </div>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3 lg:p-5 border-b border-gray-200">
                    test 4
                </div>
            </div>
            <div class="bg-white overflow-hidden mb-1">
                <div class="p-3 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="w-1/4">
                            @livewire('search-input')
                        </div>
                        <div class="flex gap-4">
                            <a wire:navigate href="{{route('sales.add')}}" class="bg-zinc-700 flex rounded-none text-sm transform duration-300 hover:bg-zinc-800 hover:-translate-y-1 text-white py-2 px-5">
                                {{ __('Create Sales Record') }}
                            </a>
                            <x-button type="button" class="bg-sky-500 flex rounded-none text-sm transform duration-300 hover:bg-sky-600 hover:-translate-y-1 text-white py-1 px-2">
                                {{ __('Import CSV') }}
                            </x-button>
                        </div>
                    </div>
                </div>
                {{-- <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div class="w-1/4">
                            @livewire('search-input')
                        </div>
                        @can('create')
                            @livewire('supplier.supplier-modal')
                        @endcan
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 w-full">
                    @livewire('supplier.all')
                </div> --}}
            </div>

            @livewire('sales.all')
        </div>
    </div>
</x-app-layout>
