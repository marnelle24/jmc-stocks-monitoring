<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Livewire\Forms\SalesOrderForm;

class Create extends Component
{
    public SalesOrderForm $form;

    public $salesItems = [];

    protected $listeners = [
        'getSelectedProduct' => 'getProductItems'
    ];

    public function mount()
    {
        $this->form->salesOrder['created_by'] = auth()->user()->name;
        $this->form->salesOrder['sale_date'] = \Carbon\Carbon::now()->toDateString();
    }

    public function getProductItems($value)
    {
        // Check if the object already exists in the array based on 'id'
        $exists = collect($this->salesItems)->firstWhere('id', $value['id']);

        if($exists)
            $this->dispatch('errorLabel', message: 'Product already added. Please select another.');
        else 
        {
            $value['quantity'] = 1;
            $value['taxAmount'] = 0;
            $value['profitPerProduct'] = $value['selling_price']-$value['buying_price'];
            $value['netProfit'] = ($value['quantity']*$value['selling_price'])-$value['taxAmount'];
            array_push($this->salesItems, $value);
            $this->dispatch('successLabel', message: 'Product added successfully.');
        } 
    }

    // Method to detect changes for individual object quantity
    public function updatedSalesItems($value, $name)
    {
        list($index, $field) = explode('.', $name);
        // $index is the index of the object in the loop
        // $field is the field being updated (e.g., 'quantity')
        $this->salesItems[$index][$field] = $value;
        
        // Recalculate the Profict/product once the sold price is changed.
        $this->salesItems[$index]['profitPerProduct'] = floatval($this->salesItems[$index]['selling_price']) - floatval($this->salesItems[$index]['buying_price']);
        
        // Recalculate the individual total for the updated object
        $this->salesItems[$index]['netProfit'] = (intval($this->salesItems[$index]['quantity']) * floatval($this->salesItems[$index]['selling_price'])) - floatval($this->salesItems[$index]['taxAmount']);
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


    public function submit()
    {
        $this->form->salesOrder['salesItems'] = $this->salesItems;
        // dump($this->form);
        $this->form->save();
    }

    public function render()
    {
        return view('livewire.sales.sales-form');
    }
}
