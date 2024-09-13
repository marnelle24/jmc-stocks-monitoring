<div>
    <form wire:submit="save">
        <div class="flex gap-8">
            <div class="w-3/4">
                <div class="flex flex-col gap-8">
                    <div class="flex gap-8 justify-evenly">
                        <div class="w-1/2">
                            <x-label class="capitalize">Product Code <em class="text-xs">(Optional)</em></x-label>
                            <x-input :disabled="$form->product['supplier_id']" wire:model="form.product.productCode" placeholder="Auto-generated" class="disabled:bg-gray-100 rounded-md capitalize w-full" />
                        </div>
                        <div class="w-1/2">
                            <x-label class="capitalize">Name</x-label>
                            <x-input wire:model="form.product.name" placeholder="Name" class="rounded-md capitalize w-full" />
                            <x-input-error for="form.product.name" />
                        </div>
                        <div class="w-1/2">
                            <x-label class="capitalize">Supplier <em>(Optional)</em></x-label>
                            @livewire('supplier.search-and-select', ['selectedSupplier' => $form->product['supplier_id']])
                        </div>
                    </div>
                    <div class="flex gap-8 justify-evenly">
                        <div class="w-1/4">
                            <x-label class="capitalize"> Currency </x-label>
                            <x-input type="text" wire:model="form.product.currency" placeholder="Currency" class="capitalize w-full" />
                        </div>
                        <div class="w-1/4">
                            <x-label class="capitalize"> Buying Price </x-label>
                            <x-input type="number" step="0.01" wire:model="form.product.buying_price" placeholder="Buying Price" class="capitalize w-full" />
                            <x-input-error for="form.product.buying_price" />
                        </div>
                        <div class="w-1/4">
                            <x-label class="capitalize"> Selling Price </x-label>
                            <x-input type="number" step="0.01" wire:model="form.product.selling_price" placeholder="Selling Price" class="capitalize w-full" />
                            <x-input-error for="form.product.selling_price" />
                        </div>
                        <div class="w-1/4">
                            <x-label class="capitalize"> Unit </x-label>
                            <select wire:model="form.product.unit" class="capitalize w-full border-zinc-200 rounded-md">
                                <option value="">-Select Unit-</option>
                                <option value="pcs">pcs</option>
                                <option value="dozen">dozen</option>
                                <option value="kilo">kilo</option>
                                <option value="sack">sack</option>                                
                            </select>
                            <x-input-error for="form.product.unit" />
                        </div>
                    </div>
                    <div class="flex gap-8 justify-evenly">
                        <div class="w-1/2">
                            <x-label class="capitalize"> Description </x-label>
                            <textarea wire:model="form.product.description" class="w-full border-zinc-200 rounded-md" rows="6" placeholder="Description"></textarea>
                        </div>
                        <div class="w-1/2">
                            <x-label class="capitalize font-bold text-md">Keyword <em>(For easy searching)</em></x-label>
                            <textarea class="capitalize w-full border-zinc-200 rounded-md shadow mt-1" rows="6" wire:model="form.product.keyword"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/4 flex flex-col gap-8">
                <div class="min-h-[200px]  flex justify-center border-4 border-zinc-400/40 shadow-md items-center bg-zinc-100">
                    @if($id)
                        @php
                            $_name = explode(' ', $form->product['name']);
                            $_txt = '';
                            foreach ($_name as $value) {
                                $_txt .= substr(strtoupper($value), 0, 1);
                            }
                            echo '<img class="uppercase opacity-60 w-full" src="https://placehold.co/100x100?text='.$_txt.'" />';
                        @endphp
                    @else
                        <p class=" text-zinc-400/40 text-6xl font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-12 w-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </p>
                    @endif
                </div>
                <div>
                    <x-label class="font-bold text-md mb-2">Categories <em>(Select multiple categories)</em></x-label>
                    @livewire('category.list-and-select', ['selectedCat' => $form->product['categories']])
                </div>
            </div>
        </div>
        <div class="flex gap-2">
            <x-button class="bg-zinc-700 mt-4 transform duration-300 hover:bg-zinc-800 hover:-translate-y-1 text-white p-4">
                {{ __('Submit') }}
            </x-button>
            @if(!$id)
                <x-button type="reset" class="bg-zinc-300 mt-4 transform duration-300 hover:bg-zinc-400 hover:-translate-y-1 text-zinc-500 p-4">
                    {{ __('Reset') }}
                </x-button>
            @endif
        </div>    
    </form>
</div>
