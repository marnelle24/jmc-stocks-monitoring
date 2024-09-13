<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class All extends Component
{
    use WithPagination; 
    public $search;

    protected $listeners = [
        'getSearchedKeyword' => 'loadSearchResult',
        'successLabel' => 'suppliers'
    ];

    public function loadSearchResult($value)
    {
        $this->search = $value;
    }

    #[Computed]
    public function suppliers()
    {
        $suppliers = Supplier::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(8);

        return $suppliers; 
    }
}
