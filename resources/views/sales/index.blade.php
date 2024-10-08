@section('title', 'Sales')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Revenue Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div 
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 2500)" 
                    x-show="show" 
                    x-transition:enter="transition ease-out duration-500" 
                    x-transition:enter-start="opacity-0" 
                    x-transition:enter-end="opacity-100" 
                    x-transition:leave="transition ease-in duration-500" 
                    x-transition:leave-start="opacity-100" 
                    x-transition:leave-end="opacity-0" 
                    class="w-full bg-green-300/70 border rounded mb-4 border-green-500 text-green-700 p-4">
                    {{ session('message') }}
                </div>
            @endif
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
            </div>

            @livewire('sales.all')
        </div>
    </div>
</x-app-layout>
