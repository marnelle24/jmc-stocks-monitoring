<div>
    <x-button wire:click="show" type="button" class="bg-zinc-700 transform duration-300 hover:bg-zinc-800 hover:-translate-y-1 text-white p-4">
        {{ __('Add Category') }}
    </x-button>

    <x-modal wire:model="isOpen">
        <div class="header">
            <div class="border-b-2 border-orange-400 bg-orange-400/80">
                <h2 class="text-lg p-4 font-bold text-white drop-shadow">Category Details</h2>
            </div>
        </div>

        <div class="content p-8">
            <x-validation-errors class="mb-4" />
            <form wire:submit="save">
                <div class="flex flex-col">
                    <x-label class="capitalize mb-4"> Category Name </x-label>
                    <x-input wire:model="form.category.name" placeholder="Name" class="capitalize w-full" />
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
