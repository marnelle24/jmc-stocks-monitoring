<div>
    <form wire:submit="save">
        <div class="bg-white overflow-hidden shadow-sm">
            <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
                <div class="flex gap-8">
                    <div class="w-3/4 flex flex-col gap-6">
                        <div>
                            <span class="uppercase font-thin text-xs text-gray-500">Sales Order No. (optional)</span>
                            <x-input placeholder="Auto-generated if not specified" class="disabled:bg-gray-100 rounded-none w-full" />
                        </div>
                        <div>
                            <span class="uppercase font-thin text-xs text-gray-500">Customer Name</span>
                            <x-input placeholder="Customer Name" class="rounded-none capitalize w-full" />
                        </div>

                        <div class="flex w-full gap-8">
                            <div class="w-1/2">
                                <span class="uppercase font-thin text-xs text-gray-500">Total Amount</span>
                                <x-input type="text" placeholder="PHP0.00" class="capitalize w-full" />
                            </div>
                            <div class="w-1/2">
                                <span class="uppercase font-thin text-xs text-gray-500">Discount Given {Optional)</span>
                                <x-input type="number" step="0.01" placeholder="PHP0.00" class="capitalize w-full" />
                            </div>
                        </div>
                    </div>


                    <div class="w-1/4 flex flex-col gap-6">
                        <div>
                            <span class="uppercase font-thin text-xs text-gray-500">Transaction Date</span>
                            <x-input type="date" placeholder="Auto-generated" class="disabled:bg-gray-100 rounded-none capitalize w-full" />
                        </div>   
                        <div>
                            <span class="uppercase font-thin text-xs text-gray-500">Payment Method</span>
                            <select class="border-gray-300 rounded-none capitalize w-full">
                                <option value="cash">Cash</option>
                                <option value="gcash">GCash</option>
                                <option value="check">Check</option>
                            </select>
                        </div>     
                        <div>
                            <span class="uppercase font-thin text-xs text-gray-500">Status</span>
                            <select class="border-gray-300 rounded-none capitalize w-full">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="refunded">Refund</option>
                            </select>
                        </div>
                        <div>
                            <span class="uppercase font-thin text-xs text-gray-500">Prepared By</span>
                            <x-input type="text" placeholder="Name" class="disabled:bg-gray-100 rounded-none capitalize w-full" />
                        </div>
                        <div>
                            <span class="uppercase font-thin text-xs text-gray-500">Approved By</span>
                            <x-input type="text" placeholder="Name" class="disabled:bg-gray-100 rounded-none capitalize w-full" />
                        </div>                                   
                    </div>
                </div>
            </div>
        </div>

        {{-- transction items --}}
        <div class="mt-8">
            <p class="my-2 font-bold">Sales Order Item{s}</p>
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="bg-gray-100">
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">Product</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">SKU</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold" width="8%">Qnty</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">Cost</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">Sold Price</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">Profit/Product</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">Tax Amnt</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">Net Profit</td>
                                <td class="p-4 border-y text-sm border-gray-300 font-bold">&nbsp;</td>
                            </tr>
                        </thead>
                        @foreach ($salesItems as $item)
                            <tr>
                                <td class="p-4 text-sm border-y duration-300 text-left">{{$item['name']}}</td>
                                <td class="p-4 text-sm border-y duration-300 text-left">{{$item['productCode']}}</td>
                                <td class="p-4 text-sm border-y duration-300 text-left">1</td>
                                <td class="p-4 text-sm border-y duration-300 text-left">{{ '₱'.number_format($item['buying_price'], 2) }}</td>
                                <td class="p-4 text-sm border-y duration-300 text-left">{{ '₱'.number_format($item['selling_price'], 2) }}</td>
                                <td class="p-4 text-sm border-y duration-300 text-left">{{ '₱'.number_format(1000, 2) }}</td>
                                <td class="p-4 text-sm border-y duration-300 text-left">{{ '₱'.number_format(50, 2) }}</td>
                                <td class="p-4 text-sm border-y duration-300 text-left">{{ '₱'.number_format(3500, 2) }}</td>
                                <td class="p-4 text-sm border-y duration-300 text-right">
                                    <button wire:click="removeItem({{$item['id']}})" type="button" class="hover:-translate-y-0.5 text-red-400 hover:text-red-600 font-bold duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($salesItems) == 0)
                            <tr>
                                <td class="p-4 text-sm border-y duration-300 text-center" colspan="9">
                                    <p class="italic">Add product(s) to sales transaction</p>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm mt-8">
            <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
                <div class="flex justify-between gap-2">
                    <div>
                        <x-button class="bg-zinc-700 transform rounded-none duration-300 hover:bg-zinc-800 focus:bg-zinc-500 hover:-translate-y-1 text-white p-4">
                            {{ __('Submit') }}
                        </x-button>
                        <x-button type="reset" class="bg-zinc-500 transform rounded-none duration-300 hover:bg-zinc-600 focus:bg-zinc-500 hover:-translate-y-1 text-white p-4">
                            {{ __('Reset') }}
                        </x-button>
                    </div>
                    <x-button wire:click="$dispatch('openAddUpdateSalesItem')" type="button" class="bg-sky-500 transform rounded-none duration-300 hover:bg-sky-600 focus:bg-sky-700 hover:-translate-y-1 text-white p-4">
                        {{ __('Add Product Item') }}
                    </x-button>
                </div>    
                @livewire('sales.add-update-item')
            </div>
        </div>
    </form>
</div>
