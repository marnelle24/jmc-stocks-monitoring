<div>
    <x-modal wire:model="isOpen">
        <div class="header">
            <div class="border-b-2 border-teal-700 bg-teal-600">
                <h2 class="text-lg p-4 font-bold text-white drop-shadow">
                    Add Sales Item(s)
                </h2>
            </div>
        </div>

        <div class="content">
            <div class="flex flex-col">
                <div class="p-8">
                    <x-input wire:model.live.debounce.500ms="search" class="p-3 w-full bg-sky-50/40" type="search" placeholder="Search" />
                </div>
                @foreach ($this->products as $product)
                    <p wire:key="{{$product->id}}" class="px-8 py-3 border-b flex gap-2 capitalize">
                        <button wire:click="addItem({{$product}})" type="button" class="hover:-translate-y-0.5 hover:text-blue-400 font-bold duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                        {{$product->name}}
                    </p>
                @endforeach
                <div class="p-8">
                    {{ $this->products->links('vendor.livewire.custom-pagination') }}
                </div>
            </div>
               
        </div>
    </x-modal>
</div>
