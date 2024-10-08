<div class="overflow-hidden shadow-md rounded-b-xl">
    {{-- @dump($this->sales[0]) --}}
    <table class="w-full table-fixed">
        <thead>
            <tr>
                <td class="p-4 border-y border-gray-300 bg-white font-bold" width="10%">SO#</td>
                <td class="p-4 border-y border-gray-300 bg-white font-bold">Trxn Date</td>
                <td class="p-4 border-y border-gray-300 bg-white font-bold">Customer</td>
                <td class="p-4 border-y border-gray-300 bg-white font-bold" width="10%">Amount</td>
                <td class="p-4 border-y border-gray-300 bg-white font-bold" width="10%">Discount</td>
                <td class="p-4 border-y border-gray-300 bg-white font-bold" width="10%">Profit</td>
                <td class="p-4 border-y border-gray-300 bg-white font-bold">Payment</td>
                <td class="p-4 border-y border-gray-300 bg-white font-bold text-right">Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach ( $this->sales as $key => $sale )
                <tr wire:key="{{$key}}" class="hover:bg-gray-200/70 bg-gray-50 hover:-translate-y-0.5 hover:shadow-lg duration-300">
                    <td class="p-4 text-sm border-y border-gray-300 font-bold hover:font-bold hover:text-blue-600 duration-300">
                        <a href="{{route('sales.single', $sale->sales_order_no)}}">
                            {{$sale->sales_order_no}}
                        </a>
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">
                        {{ $this->date_format($sale->sale_date) }}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300">{{$sale->customer_name}}</td>
                    <td class="p-4 text-sm border-y border-gray-300">{{ '₱'.number_format($sale->total_amount, 2) }}</td>
                    <td class="p-4 text-sm border-y border-gray-300">{{ '₱'.number_format($sale->total_discount, 2) }}</td>
                    <td class="p-4 text-sm border-y border-gray-300">{{ '₱'.number_format(($sale->total_amount - $sale->discount), 2) }}</td>
                    <td class="p-4 text-sm border-y border-gray-300 capitalize">
                        {{$sale->payment_method}}
                    </td>
                    <td class="p-4 text-sm border-y border-gray-300 text-right capitalize">
                        <span class="rounded-full px-2.5 py-1 text-white bg-green-600">
                            {{$sale->status}}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

    <div class="p-3 bg-gray-100">
        {{ $this->sales->links('vendor.livewire.custom-pagination') }}
    </div>
</div>