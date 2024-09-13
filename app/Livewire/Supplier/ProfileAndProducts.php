<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;

class ProfileAndProducts extends Component
{
    public $slug;
    public $supplier;

    use WithPagination;

    public function mount()
    {
        $this->supplier = Supplier::where('slug', '=', $this->slug)->first();
    }

    public function render()
    {
        $products = $this->supplier->products()->paginate(7);
        return view('livewire.supplier.profile-and-products', [
            'products' => $products
        ]);
    }
}
