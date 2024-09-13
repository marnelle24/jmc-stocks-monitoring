<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Livewire\Forms\ProductForm;

class UpdateProduct extends Component
{
    public $id;
    public ProductForm $form;

    protected $listeners = [
        'getSelectedCat' => 'getCategories',
        'getSelectedSupplier' => 'getSupplier'
    ];

    public function mount()
    {
        if($this->id)
        {
            $product = Product::findorfail($this->id);
            $this->form->setProduct($product);
        }
    }
    
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
        if($this->id)
            $this->form->update();
        else
            $this->form->save();
    }
    
    public function render()
    {
        return view('livewire.product.product-form');
    }
}
