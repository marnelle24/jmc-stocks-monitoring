<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Livewire\Forms\ProductForm;

class AddProduct extends Component
{
    public ProductForm $form;
    
    protected $listeners = [
        'getSelectedCat' => 'getCategories',
        'getSelectedSupplier' => 'getSupplier'
    ];

    public function getSupplier($value)
    {
        $this->form->product['supplier_id'] = $value;
    }

    public function getCategories($value)
    {
        $this->form->product['categories'] = $value;
    }

    public function save()
    {
        // dump($this->form->product['supplier_id']);
        $this->form->save();
    }

    public function render()
    {
        // return view('livewire.product.add-product');
        return view('livewire.product.product-form');
    }
}
