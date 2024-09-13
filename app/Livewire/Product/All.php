<?php

namespace App\Livewire\Product;

use App\Models\Product;
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
    public function products()
    {
        $products = Product::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10);

        return $products; 
    }

}
