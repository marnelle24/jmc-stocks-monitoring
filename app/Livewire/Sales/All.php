<?php

namespace App\Livewire\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class All extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = [
        'getSearchedKeyword' => 'loadSearchResult',
    ];

    public function loadSearchResult($value)
    {
        $this->search = $value;
    }


    #[Computed]
    public function sales()
    {
        $sales = Sales::latest('sale_date')
            ->where('customer_name', 'like', "%{$this->search}%")
            ->orWhere('sales_order_no', 'like', "%{$this->search}%")
            ->paginate(10);
            
        return $sales;
    }

    public function date_format($timestamp)
    {
        return Carbon::parse($timestamp)->format('M j, Y');
    }
}
