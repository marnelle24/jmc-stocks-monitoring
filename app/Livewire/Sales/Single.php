<?php

namespace App\Livewire\Sales;

use Livewire\Component;

class Single extends Component
{
    public $sales_order_no;
    
    public function render()
    {
        return view('livewire.sales.single');
    }
}
