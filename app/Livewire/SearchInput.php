<?php

namespace App\Livewire;

use Livewire\Component;

class SearchInput extends Component
{
    public $search;

    public function updatedSearch($keyword)
    {
        $this->dispatch('getSearchedKeyword', $keyword);
    }

    public function render()
    {
        return view('livewire.search-input');
    }
}
