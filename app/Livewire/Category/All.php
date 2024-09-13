<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class All extends Component
{
    use WithPagination; 

    public $search;

    protected $listeners = [
        'getSearchedKeyword' => 'loadSearchResult',
        'successLabel' => 'categories'
    ];

    public function loadSearchResult($value)
    {
        $this->search = $value;
    }

    #[Computed]
    public function categories()
    {
        $categories = Category::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10);

        return $categories; 
    }
}
