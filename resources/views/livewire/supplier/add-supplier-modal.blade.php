<div>
    <x-button wire:click="show" type="button" class="bg-zinc-700 transform duration-300 hover:bg-zinc-800 hover:-translate-y-1 text-white p-4">
        {{ __('Add Supplier') }}
    </x-button>

    <x-modal wire:model="isOpen">
        <div class="header">
            <div class="border-b-2 border-sky-700 bg-sky-600">
                <h2 class="text-lg p-4 font-bold text-white drop-shadow capitalize">Supplier Details</h2>
            </div>
        </div>

        <div class="content p-8">
            <x-validation-errors class="mb-4" />
            <form wire:submit="save">
                <div class="flex flex-col gap-8">
                    <div>
                        <x-label class="capitalize"> Name </x-label>
                        <x-input wire:model="form.supplier.name" placeholder="Name" class="capitalize w-full" />
                        <x-input-error for="form.supplier.name" />
                    </div>
                    <div>
                        <x-label class="capitalize"> Contact Number </x-label>
                        <x-input wire:model="form.supplier.contactNumber" placeholder="Contact Number" class="rounded-md capitalize w-full" />
                    </div>
                    <div>
                        <x-label class="capitalize"> Contact Person </x-label>
                        <x-input wire:model="form.supplier.contactPerson" placeholder="Contact Person" class="capitalize w-full" />
                    </div>
                    <div>
                        <x-label class="capitalize"> Description </x-label>
                        <textarea wire:model="form.supplier.short_details" class="w-full" rows="6" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="flex gap-2">
                    <x-button class="bg-zinc-700 mt-4 transform duration-300 hover:bg-zinc-800 hover:-translate-y-1 text-white p-4">
                        {{ __('Submit') }}
                    </x-button>
                    <x-button wire:click="hide" type="button" class="bg-zinc-300 mt-4 transform duration-300 hover:bg-zinc-400 hover:-translate-y-1 text-zinc-700 p-4">
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            </form>
        </div>
        
    </x-modal>
</div>
