@section('title', 'Users')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Masterlist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div class="success bg-green-200/70 border border-green-500/70 text-green-700 p-4 rounded mb-4">
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
                            <div>
                                <a wire:navigate href="{{route('user.add')}}" class="bg-zinc-700 flex rounded-none text-sm transform duration-300 hover:bg-zinc-800 hover:-translate-y-1 text-white py-2 px-5">
                                    {{ __('Add User') }}
                                </a>
                            </div>
                        @endif
                        {{-- @can('create')
                            @livewire('user.all')
                        @endcan --}}
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 w-full">
                    @livewire('user.all')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
