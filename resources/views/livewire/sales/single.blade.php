<div class="flex flex-col gap-4">
    {{-- @dump($salesOrder) --}}
    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3 lg:p-5 border-b border-gray-200">
        <table class="w-full table-fixed">
            <tr>
                <td>
                    <p class="p-4 capitalize text-lg flex flex-col font-bold">
                        <span class="uppercase font-thin text-xs text-gray-500">Sales Order No.</span> 
                        {{$salesOrder->sales_order_no}}
                    </p>
                </td>
                <td>
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Transaction Date</span> 
                        {{ $this->date_format($salesOrder->sale_date) }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Customer Name</span> 
                        {{$salesOrder->customer_name}}
                    </p>
                </td>
                <td>
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Payment Method</span> 
                        {{$salesOrder->payment_method}}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Total Amount</span> 
                        {{ '₱'.number_format($salesOrder->total_amount, 2) }}
                    </p>
                </td>
                <td>
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Payment Status</span> 
                        {{$salesOrder->status}}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Discount</span> 
                        {{ '₱-'.number_format(($salesOrder->total_discount), 2) }}
                    </p>
                </td>
                <td class="flex gap-8">
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Prepared By</span> 
                        {{$salesOrder->created_by ? $salesOrder->created_by : 'Marnelle Apat'}}
                    </p>
                    <p class="p-4 capitalize text-lg flex flex-col">
                        <span class="uppercase font-thin text-xs text-gray-500">Approved By</span> 
                        {{$salesOrder->created_by ? $salesOrder->created_by : 'Amie Apat'}}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <p class="mt-6 font-bold">Transcation Item(s)</p>
    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3 lg:p-5 border-b border-gray-200">
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
                    <td class="p-4 border-y text-sm border-gray-300 font-bold text-right">Status</td>
                </tr>
            </thead>
            <tbody>
                @foreach ( $salesOrder->salesItem as $salesItem)
                <tr wire:key="{{$salesItem->id}}" class="">
                    <td class="p-4 text-sm border-y duration-300 capitalize">
                        {{ $salesItem->product->name }}
                    </td>
                    <td class="p-4 text-sm border-y duration-300 capitalize">
                        {{ $salesItem->product->productCode ? $salesItem->product->productCode : '###-###' }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">
                        {{ $salesItem->quantity }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">
                        {{ '₱'.number_format($salesItem->productCost, 2) }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">
                        {{ '₱'.number_format($salesItem->sellingPrice, 2) }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">
                        {{ '₱'.number_format($salesItem->profitPerProduct, 2) }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">
                        {{ '₱'.number_format($salesItem->tax_amount, 2) }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">
                        {{ '₱'.number_format($salesItem->totalProfit, 2) }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300 text-right uppercase">
                        {{ $salesItem->status }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            
    </div>

</div>
