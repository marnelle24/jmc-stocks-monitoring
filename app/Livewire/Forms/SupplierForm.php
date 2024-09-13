<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Supplier;
use Livewire\Attributes\Validate;

class SupplierForm extends Form
{
    public $supplier = [
        'id' => null,
        'name' => '',
        'contactNumber' => '',
        'contactPerson' => '',
        'short_details' => ''
    ];

    public function rules()
    {
        $rules = [
            'supplier.name' => 'required|min:4|max:255',
            'supplier.contactNumber' => 'nullable',
            'supplier.contactPerson' => 'nullable',
            'supplier.short_details' => 'nullable|max:255'
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'supplier.name.required'    => 'Supplier name must not be empty',
            'supplier.name.min'         => 'Supplier Name too short. Atleast 4 characters',
            'supplier.name.max'         => 'Supplier Name too long. Atleast 250 characters',
            'supplier.short_details.max'=> 'Description limit exceeded. Atleast 250 characters',
        ];

        return $messages;
    }

    public function loadData($supplier)
    {
        $this->supplier = [
            'id' => $supplier->id,
            'name' => $supplier->name,
            'contactNumber' => $supplier->contactNumber,
            'contactPerson' => $supplier->contactPerson,
            'short_details' => $supplier->short_details
        ];
    }

    public function save()
    {
        $this->validate(); 

        if( isset( $this->supplier['id'] ) )
            Supplier::find($this->supplier['id'])->update($this->supplier);
        else
            Supplier::create($this->supplier);

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->supplier = [
            'name' => '',
            'contactNumber' => '',
            'contactPerson' => '',
            'short_details' => ''
        ];

        $this->resetErrorBag();
        $this->resetValidation();
    }
}
