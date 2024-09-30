<?php

namespace App\Livewire\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use Livewire\Component;

class Single extends Component
{
    public $sales_order_no;
    public $salesOrder;

    public function mount()
    {
        $this->salesOrder = Sales::where('sales_order_no', '=', $this->sales_order_no)
            ->with('salesItem.product')
            ->first();
    }

    public function date_format($timestamp)
    {
        return Carbon::parse($timestamp)->format('F j, Y');
    }
    
    public function render()
    {
        return view('livewire.sales.single');
    }
}
