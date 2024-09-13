<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Category;
use Livewire\Attributes\Validate;

class CategoryForm extends Form
{
    public $category = [
        'id' => null,
        'name' => ''
    ];

    public function rules()
    {
        $rules = [
            'category.name' => 'required|min:4|max:255',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'category.name.required'    => 'Name must not be empty',
            'category.name.min'         => 'Name too short. Atleast 4 characters',
            'category.name.max'         => 'Name too long. Atleast 250 characters',
        ];

        return $messages;
    }

    public function loadData($cat)
    {
        $this->category = [
            'id' => $cat->id,
            'name' => $cat->name,
        ];
    }

    public function save()
    {
        $this->validate();

        if( isset( $this->category['id'] ) )
            Category::find($this->category['id'])->update($this->category);
        else
            Category::create($this->category);

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->category = [
            'name' => ''
        ];

        $this->resetErrorBag();
        $this->resetValidation();
    }
}
