<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;

class SearchAndSelect extends Component
{
    public $suppliers;
    public $keyword;
    public $selectedSupplier;
    public $showResult = false;

    public function updatedKeyword()
    {
        $this->showResult = true;
        // $this->selectedSupplier = '';
        $this->suppliers = Supplier::where('name', 'like', "%{$this->keyword}%")
            ->orderby('name', 'ASC')
            ->pluck('name', 'id');
    }

    public function mount()
    {
        $this->suppliers = Supplier::where('name', 'like', "%{$this->keyword}%")
            ->orderby('name', 'ASC')
            ->pluck('name', 'id');

        if($this->selectedSupplier)
            $this->keyword = $this->suppliers[$this->selectedSupplier];
    }

    public function getSelectedSupplier($id)
    {
        $this->showResult = false;
        $this->keyword = $this->suppliers[$id];
        $this->selectedSupplier = $id;
        $this->dispatch('getSelectedSupplier', $id);
    }

    public function render()
    {
        return view('livewire.supplier.search-and-select');
    }
}
