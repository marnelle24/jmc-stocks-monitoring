<div x-data x-init="$refs.searchInput.focus()">
    {{-- <x-input wire:model.live.debounce.500ms="search" type="search" class="w-full px-3 py-5 text-lg shadow-lg" placeholder="Find Products.." /> --}}
    <x-input 
        x-ref="searchInput"
        wire:model.live.debounce.500ms="search" 
        wire:keydown.enter="performSearch"
        type="search" 
        class="w-full px-3 py-5 text-lg shadow-lg" 
        placeholder="Find Products.." 
    />
    <br />
    <br />
    <p class="italic text-gray-600 mt-6 mb-3">
        {{$label}}
    </p>
        {{-- @dd($products) --}}
        @if (count($products))
        <div class="grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-1 grid-cols-1 gap-8">
            @foreach ($products as $product)
                <div wire:key="{{$product->id}}" class="bg-gray-100 overflow-hidden shadow-xl transform hover:-translate-y-1 duration-300">
                    <div class="bg-[#DDD] border-b border-b-gray-200 border-t border-t-gray-100">
                        @php
                            $_name = explode(' ', $product->name);
                            $_txt = '';
                            foreach ($_name as $value) {
                                $_txt .= substr(strtoupper($value), 0, 1);
                            }
                            echo '<img class="uppercase w-full h-32" src="https://placehold.co/100x100?text='.$_txt.'" />';
                        @endphp
                    </div>

                    <div class="relative bg-gray-100 pt-3 pb-4 px-4 lg:px-4 gap-2 flex flex-col items-start justify-center">
                        <div>
                            <a href="{{route('product.single', $product->slug)}}" class="text-[11px] bg-gray-400 uppercase p-1 text-gray-200 transform duration-300 shadow hover:-translate-y-1 hover:bg-green-600 leading-relaxed text-xs text-center font-thin">
                                {!! $product->productCode ? $this->highlight($product->productCode) : 'N/A' !!}
                            </a>
                        </div>
                        <div class="min-h-150px] w-full flex flex-col gap-4 justify-between">
                            <div class="w-full">
                                <a href="{{route('product.single', $product->slug)}}" class="text-gray-500 leading-0 text-xl font-bold capitalize transform duration-300 hover:-translate-y-1 hover:underline hover:opacity-90">
                                    {!! $this->highlight(Str::words($product->name, 4, ' ...')) !!}
                                </a>
                            </div>
                            <div class="flex">
                                <div class="w-1/2">
                                    <p class="text-gray-500 leading-0 text-sm font-thin capitalize italic">
                                        {!! $this->highlight(Str::words($product->supplier->name, 4, ' ...')) !!}
                                    </p>
                                    <p class="text-gray-500 leading-0 text-sm font-thin italic capitalize">Unit: By {{ $product->unit }}</p>
                                </div> 
    
                                <div class="w-1/2 flex gap-1 flex-col justify-start items-start">
                                    <p class="text-md font-extrabold mb-4">
                                        <x-money amount="{{$product->selling_price}}" currency="{{$product->currency}}" convert /> / {{$product->unit}}
                                    </p>
                                    @can('create')
                                        <p class="text-xs font-bold">
                                            Buying: <x-money amount="{{$product->buying_price}}" currency="{{$product->currency}}" convert />
                                        </p>
                                        <p class="text-xs font-bold">
                                            Selling: <x-money amount="{{$product->selling_price}}" currency="{{$product->currency}}" convert />
                                        </p>
                                        <p class=" {{ ($product->selling_price - $product->buying_price) > 0 ? 'text-green-700' : 'text-red-700' }} text-xs font-bold text-left">
                                            Margin: <x-money amount="{{$product->selling_price - $product->buying_price}}" currency="{{$product->currency}}" convert /> / {{$product->unit}}
                                        </p>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        {{-- {{ $product->productCode ? $product->productCode : 'N/A' }} - {{ $product->name }} --}}
                        <div class="mt-8">
                            @if ($product->keyword)
                                <p class="text-xs italic text-gray-500 py-4 font-thin">
                                    <span class="font-bold">Keyword: </span>
                                    {!! $this->highlight($product->keyword) !!}
                                </p>
                            @endif
                            @foreach ($product->categories as $index => $category)
                                <a href="{{route('category.single', $category->slug)}}"
                                    class="py-1.5 px-2.5 m-0.5 text-xs rounded-full bg-zinc-500 hover:bg-zinc-600 transform duration-300 hover:-translate-x-0.5 shadow-md capitalize text-zinc-200">
                                    {!! $this->highlight($category->name) !!}
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        @else
            <p class="text-center text-3xl italic text-gray-400">No product found.</p>
        @endif
    @if (count($products))
        <div class="p-3 mt-10">
            {!! $products->links('vendor.livewire.custom-pagination') !!}
        </div>
    @endif

</div>
