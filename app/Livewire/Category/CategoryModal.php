<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use App\Livewire\Forms\CategoryForm;

class CategoryModal extends Component
{
    public CategoryForm $form;
    
    public $isOpen = false;
    public $isEdit = false;

    protected $listeners = [
        'openCategoryModal' => 'editCategory'
    ];

    public function show()
    {
        $this->isOpen = true;
    }

    public function hide()
    {
        $this->form->resetForm();
        $this->isOpen = false;
    }

    public function editCategory(Category $category)
    {
        $this->isOpen = true;
        $this->isEdit = true;
        $this->form->loadData($category);
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

    
    public function render()
    {
        return view('livewire.category.add-category-modal');
    }
}
