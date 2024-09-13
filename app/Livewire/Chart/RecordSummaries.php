<?php

namespace App\Livewire\Chart;

use Livewire\Component;

class RecordSummaries extends Component
{
    public $products = [
        'label' => 'Total Products',
        'total' => 0
    ];
    public $categories = [
        'label' => 'Total Categories',
        'total' => 0
    ];
    public $suppliers = [
        'label' => 'Total Suppliers',
        'total' => 0
    ];

    public $users = [
        'label' => 'Total Users',
        'total' => 0
    ];


    public function mount()
    {
        $totalProducts = \App\Models\Product::count();
        $totalCategories = \App\Models\Category::count();
        $totalSuppliers = \App\Models\Supplier::count();
        $totalUsers = \App\Models\User::count();
        $this->products['total'] = $totalProducts;
        $this->categories['total'] = $totalCategories;
        $this->suppliers['total'] = $totalSuppliers;
        $this->users['total'] = $totalUsers;
    }

    public function render()
    {
        return view('livewire.chart.record-summaries');
    }
}
