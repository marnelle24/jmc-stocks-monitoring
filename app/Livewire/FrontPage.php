<?php

namespace App\Livewire;

use App\Models\Keyword;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class FrontPage extends Component
{
    use WithPagination;
    public $label = 'Recently Added';
    public $search;

    public function updatedSearch()
    {
        $this->label = $this->search ? 'Search Result for : ' . $this->search :  'Recently Added';
        $this->products;
    }

    public function performSearch()
    {
        if( $this->search )
        {
            $this->label = 'Search Result for : ' . $this->search;
            $keywords = explode(' ', trim($this->search));
            $query = Product::query();
    
            foreach ($keywords as $keyword) 
            {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('productCode', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('keyword', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('selling_price', '<=', $keyword);
                });
                $query->orWhereHas('supplier', function($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%');
                });
                $query->orWhereHas('categories', function($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%');
                });
            }
    
            $p = $query
                ->with('categories')
                ->with('supplier')
                ->paginate(9);
            
            $this->products = $p;

            // Store the keyword in the db to keep trach
            $this->storeKeywords( $this->search );
        }
    }

    // Capture the seaerch keywords and keep track
    public function storeKeywords($searchTerm)
    {
        $keywords = explode(' ', $searchTerm);

        foreach ($keywords as $keyword) 
        {
            $existingKeyword = Keyword::where('keyword', $keyword)->first();

            if ($existingKeyword) 
                $existingKeyword->increment('count');
            else 
                Keyword::create([ 'keyword' => $keyword, 'count' => 1 ]);
        }
    }

    #[Computed]
    public function products()
    {
        $products = Product::latest()
            ->with('categories')
            ->with('supplier')
            ->paginate(9);

        return $products;
    }

    public function highlight($text)
    {
        $keywords = explode(' ', $this->search);
        $keywords = array_map('preg_quote', $keywords);
        $pattern = '/' . implode('|', $keywords) . '/i';
        return preg_replace($pattern, '<span class="bg-yellow-500 text-white">$0</span>', $text);
    }

}
