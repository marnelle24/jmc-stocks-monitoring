<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class ListAndSelect extends Component
{
    public $selectedCat = [];

    public function updatedSelectedCat() 
    {
        $this->dispatch('getSelectedCat', $this->selectedCat);
    }



    public function render()
    {
        $categories = Category::orderby('name', 'ASC')->pluck('name', 'id');
        return view('livewire.category.list-and-select', [
            'categories' => $categories
        ]);
    }
}
