@section('title', 'Product')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div class="w-1/4">
                            @livewire('search-input')
                        </div>
                        @if(auth()->user()->can('create'))
                            @livewire('category.category-modal')
                        @endif
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 w-full">
                    @livewire('category.all')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
