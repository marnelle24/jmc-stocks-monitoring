<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
            <p class="font-bold italic py-2 opacity-60">Basic Information</p>
            <table>
                <tr class="border">
                    <td class="bg-gray-200/40 w-[20%] p-2 text-lg border">Name</td>
                    <td class="p-2 text-lg border">{{$supplier->name}}</td>
                </tr>
                <tr class="border">
                    <td class="bg-gray-200/40 p-2 text-lg border">Contact Person</td>
                    <td class="p-2 text-lg border">{{$supplier->contactPerson ? $supplier->contactPerson : 'N/A'}}</td>
                </tr>
                <tr class="border">
                    <td class="bg-gray-200/40 p-2 text-lg border">Contact Number</td>
                    <td class="p-2 text-lg border">{{$supplier->contactNumber ? $supplier->contactNumber : 'N/A'}}</td>
                </tr>
            </table>
        </div>
    </div>
    <br />
    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-3 lg:p-5 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold">
                Products
            </h1>
        </div>

        <div class="bg-gray-200 bg-opacity-25 w-full">
            @if (count($products) > 0)
                @foreach ( $products as $product )
                    <div wire:key="{{$product->id}}" class="border p-3 flex justify-between gap-4 hover:bg-gray-100 overflow-auto">
                        <div class="w-1/4 flex gap-2 items-center">
                            @php
                                $_name = explode(' ', $product->name);
                                $_txt = '';
                                foreach ($_name as $value) {
                                    $_txt .= substr(strtoupper($value), 0, 1);
                                }
                                echo '<img class="uppercase border-2 border-zinc-400 w-8 h-8" src="https://placehold.co/100x100?text='.$_txt.'" />';
                                echo '<div>';
                                    echo '<p class="capitalize">'.$product->name.'</p>';
                                    echo '<p class="text-[10px] bg-gray-300 uppercase px-1">'.$product->productCode.'</p>';
                                echo '</div>';
                            @endphp
                        </div>
                        @can('create')
                            <div class="w-1/4 italic flex flex-col">
                                <p class="text-xs font-bold text-left">Buying: {{$product->currency }} {{ $product->buying_price }}</p>
                                <p class="text-xs font-bold text-left">Selling: {{$product->currency }} {{ $product->selling_price }}</p>
                                <p class=" {{ ($product->selling_price - $product->buying_price) > 0 ? 'text-green-700' : 'text-red-700' }} text-xs font-bold text-left">
                                    Margin: {{$product->currency }} {{ $product->selling_price - $product->buying_price }} / {{$product->unit}}
                                </p>
                            </div>
                        @endcan

                        <div class="w-1/4 flex justify- items-center">
                            @foreach ($product->categories as $index => $category)
                                <a href="{{route('category.single', $category->slug)}}"
                                    class="py-1.5 px-2.5 m-0.5 text-xs rounded-full bg-zinc-500 hover:bg-zinc-600 transform duration-300 hover:-translate-x-0.5 shadow-md capitalize text-zinc-200">{{ $category->name }}</a>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-1">
                            @if(auth()->user()->can('read'))
                                <a href="{{route('product.single', $product->slug)}}" class="py-2 transform duration-300 hover:-translate-y-0.5 px-3 text-xs bg-teal-600 hover:bg-teal-700 text-white">View</a>
                            @endif
                            @if(auth()->user()->can('update'))
                                <a href="{{route('product.update', $product->id)}}" class="py-2 transform duration-300 hover:-translate-y-0.5 px-3 text-xs bg-blue-600 hover:bg-blue-700 text-white">Update</a>
                            @endif
                                @if(auth()->user()->can('delete'))
                                <button class="py-2 transform duration-300 hover:-translate-y-0.5 px-3 text-xs bg-red-400 hover:bg-red-700 text-white">Delete</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-xl italic p-4 text-gray-400">No Product(s) found.</p>
            @endif
            <br />
            <div class="p-3">
                {{ $products->links('vendor.livewire.custom-pagination') }}
            </div>



        </div>
    </div>
</div>
