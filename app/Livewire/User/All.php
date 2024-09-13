<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
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
    public function users()
    {
        $users = User::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(8);
        return $users;
    }
}
