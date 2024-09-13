<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use App\Livewire\Forms\SupplierForm;

class SupplierModal extends Component
{
    public SupplierForm $form;

    public $isEdit = false;

    public $isOpen = false;

    protected $listeners = [
        'openSupplierModal' => 'editSupplier'
    ];

    public function editSupplier(Supplier $supplier)
    {
        $this->isOpen = true;
        $this->isEdit = true;
        $this->form->loadData($supplier);
    }

    public function save()
    {
        $this->form->save();
        $this->dispatch('successLabel', message: 'Changes applied successfully.');

        if($this->isEdit)
        {
            $this->isOpen = false;
            $this->isEdit = false;
        }
    }

    public function show()
    {
        $this->form->resetForm();
        $this->isOpen = true;
    }

    public function hide()
    {
        $this->form->resetForm();
        $this->isOpen = false;
    }
    
    public function render()
    {
        return view('livewire.supplier.add-supplier-modal');
    }
}
