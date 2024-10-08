@section('title', 'Add New User')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <p>Personal Information</p>
                        {{-- @can('create')
                            @livewire('user.all')
                        @endcan --}}
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 w-full">
                    @livewire('user.add')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
