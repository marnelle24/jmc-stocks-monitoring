<div>
    @foreach ( $this->categories as $category )
        <div class="border p-3 flex justify-between gap-4 hover:bg-gray-100">
            <p>{{ $category->name }}</p>
            <div class="flex gap-1 items-center">
                @if(auth()->user()->can('read'))
                    <button class="py-2 px-3 transform duration-300 hover:-translate-y-0.5 shadow-md text-xs bg-teal-600 hover:bg-teal-700 text-white">View</button>
                @endif
                @if(auth()->user()->can('update'))
                    <button wire:click="$dispatch('openCategoryModal', { 'category': {{$category}} })" class="py-2 px-3 transform duration-300 hover:-translate-y-0.5 shadow-md text-xs bg-blue-600 hover:bg-blue-700 text-white">Update</button>
                @endif
                    @if(auth()->user()->can('delete'))
                    <button class="py-2 px-3 transform duration-300 hover:-translate-y-0.5 shadow-md text-xs bg-red-400 hover:bg-red-700 text-white">Delete</button>
                @endif
            </div>
        </div>
    @endforeach
    <br />
    <div class="p-3">
        {{ $this->categories->links('vendor.livewire.custom-pagination') }}
    </div>
</div>
