@section('title', 'Sales Order Information')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Order Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('sales.single', ['sales_order_no' => $sales_order_no])
        </div>
    </div>
</x-app-layout>
