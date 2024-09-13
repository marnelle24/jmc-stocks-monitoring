@section('title', 'Product')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Masterlist') }}
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="w-1/4">
                            @livewire('search-input')
                        </div>
                        @if(auth()->user()->can('create'))
                            <a wire:navigate href="{{route('products.add')}}" class="bg-zinc-700 flex rounded-md text-sm transform duration-300 hover:bg-zinc-800 hover:-translate-y-1 text-white py-2 px-5">
                                {{ __('Add Product') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 w-full">
                    @livewire('product.all')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
