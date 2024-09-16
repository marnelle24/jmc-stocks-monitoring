<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="mb-10">
                <h1 class="text-2xl font-bold text-gray-600">Hi! {{auth()->user()->name}}</h1>
                <p class="font-thin text-gray-500 italic">Good morning. Have a wonderful day ahead...</p>
            </div>
            <div class="col-span-2 bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-4 border-b border-gray-200 bg-white">
                    Products By Category
                </div>
                <div class="bg-gray-50 bg-opacity-25 border p-4 h-[400px]">
                    @livewire('chart.product-by-category')
                </div>
            </div>   
        </div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            @livewire('chart.record-summaries')
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="grid xl:grid-cols-3 justify-center grid-cols-1 xl:gap-6 gap-0 xl:space-y-0 space-y-4">
                <div class="col-span-2">
                    <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
                        <div class="p-4 border-b border-gray-200 bg-white">
                            <p class="font-bold text-lg">Monthly Sales By Product</p>
                        </div>
                        <div class="bg-gray-50 bg-opacity-25 p-6">
                            @livewire('chart.line-chart')
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg mb-8">
                        <div class="p-4 border-b border-gray-200 bg-white">
                            <p class="font-bold text-lg">Top Search Keywords</p>
                        </div>
                        <div class="bg-gray-50 bg-opacity-25">
                            @livewire('chart.pie-chart')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-4 border-b border-gray-200 bg-white">
                    <p class="font-bold text-lg">Activity Logs</p>
                </div>
                <div class="bg-gray-50 bg-opacity-25">
                    @foreach ( [1,2,3,4,5] as $key => $x)
                        <p class="cursor-pointer hover:-translate-x-1 font-thin hover:bg-gray-200 transform duration-300 border px-4 py-3">
                            {{$key+1}}: Marnelle Apat - <span class="italic">Login</span>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
