<div class="relative">
    <x-input type="search" wire:model.live.debounce.500ms="keyword" placeholder="Search Supplier" class="capitalize w-full" />
    {{-- @dump($keyword) --}}
    @if ($showResult && count($suppliers))
        <div class="absolute w-full z-50">
            <ul class="w-full border shadow bg-white max-h-[250px] overflow-auto">
                @foreach ($suppliers as $key => $supplier)
                    <li wire:click="getSelectedSupplier( {{$key}} )" 
                        class="p-2 border-t hover:bg-gray-50 cursor-pointer">
                        {{$supplier}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
