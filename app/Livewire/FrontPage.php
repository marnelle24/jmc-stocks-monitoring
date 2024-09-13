<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class FrontPage extends Component
{
    use WithPagination;
    public $label = 'Recently Added';
    public $search;

    public function updatedSearch()
    {
        $this->label = 'Search Result for : ' . $this->search;
    }

    public function performSearch()
    {
        $this->render();
    }

    public function render()
    {
        $products = Product::latest()
            ->with('categories')
            ->with('supplier')
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('productCode', 'like', "%{$this->search}%")
            ->orWhere('keyword', 'like', "%{$this->search}%")
            ->orWhereHas('supplier', function($query) {
                $query->where('name', 'LIKE', "%{$this->search}%");
            })
            ->orWhereHas('categories', function($query) {
                $query->where('name', 'LIKE', "%{$this->search}%");
            })
            ->paginate(9);

        return view('livewire.front-page', [
            'products' => $products
        ]);
    }

    public function highlight($text)
    {
        $keyword = $this->search;
        return preg_replace("/($keyword)/i", '<span class="bg-yellow-500 text-white">$1</span>', $text);
    }
}
