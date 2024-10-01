<?php

namespace App\Livewire\Sales;

use Livewire\Component;

class AddUpdateItem extends Component
{
    public $isEdit = false;

    public $isOpen = false;

    protected $listeners = [
        'openAddUpdateSalesItem' => 'show'
    ];

    public function show()
    {
        $this->isOpen = true;
    }

    public function render()
    {
        return view('livewire.sales.add-update-item');
    }
}
