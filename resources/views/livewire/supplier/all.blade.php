<div>
    @foreach ( $this->suppliers as $supplier )
        <div class="border p-3 flex justify-between gap-4 hover:bg-gray-100">
            <div>
                <h1 class="text-lg font-bold">{{$supplier->name}}</h1>
                <p class="text-xs">
                    Contact #: {{$supplier->contactNumber}} | Contact Person: {{$supplier->contactPerson}}
                </p>
            </div>
            <div class="flex gap-1 items-center">
                @if(auth()->user()->can('read'))
                    <a href="{{route('supplier.single', $supplier->slug)}}" class="py-2 px-3 hover:-translate-y-0.5 transform duration-300 shadow-md text-xs bg-teal-600 hover:bg-teal-700 text-white">View</a>
                @endif
                @if(auth()->user()->can('update'))
                    <button wire:click="$dispatch('openSupplierModal', { 'supplier': {{$supplier}} } )" class="py-2 px-3 hover:-translate-y-0.5 transform duration-300 shadow-md text-xs bg-blue-600 hover:bg-blue-700 text-white">Update</button>
                @endif
                    @if(auth()->user()->can('delete'))
                    <button class="py-2 px-3 hover:-translate-y-0.5 transform duration-300 shadow-md text-xs bg-red-400 hover:bg-red-700 text-white">Delete</button>
                @endif
            </div>
        </div>
    @endforeach
    <br />
    <div class="p-3">
        {{ $this->suppliers->links('vendor.livewire.custom-pagination') }}
    </div>
</div>
