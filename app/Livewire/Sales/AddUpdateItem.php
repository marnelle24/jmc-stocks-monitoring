<?php

namespace App\Livewire\Sales;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class AddUpdateItem extends Component
{
    use WithPagination;
    
    public $search;
    public $isEdit = false;

    public $isOpen = false;

    protected $listeners = [
        'openAddUpdateSalesItem' => 'show'
    ];

    public function addItem($product)
    {
        $this->dispatch('getSelectedProduct', $product);
    }

    #[Computed]
    public function products()
    {
        $products = Product::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10);
        return $products; 
    }

    public function show()
    {
        $this->isOpen = true;
    }

    public function render()
    {
        return view('livewire.sales.add-update-item');
    }
}
