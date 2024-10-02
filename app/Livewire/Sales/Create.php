<?php

namespace App\Livewire\Sales;

use Livewire\Component;

class Create extends Component
{
    public $form;
    public $salesItems = [];

    protected $listeners = [
        'getSelectedProduct' => 'getProductItems'
    ];

    public function getProductItems($value)
    {
        // Check if the object already exists in the array based on 'id'
        $exists = collect($this->salesItems)->firstWhere('id', $value['id']);

        if($exists)
            $this->dispatch('errorLabel', message: 'Product already added. Please select another.');
        else 
        {
            array_push($this->salesItems, $value);
            $this->dispatch('successLabel', message: 'Product added successfully.');
        }
        
    }

    public function removeItem($id)
    {
        // Remove the object from the array by its 'id'
        $this->salesItems = array_filter($this->salesItems, function ($object) use ($id) {
            return $object['id'] !== $id;
        });

        // Reindex the array to maintain numerical keys
        $this->salesItems = array_values($this->salesItems);
    }


    public function save()
    {
        dump('test');
    }

    public function render()
    {
        return view('livewire.sales.sales-form');
    }
}
