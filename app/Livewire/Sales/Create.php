<?php

namespace App\Livewire\Sales;

use Livewire\Component;

class Create extends Component
{
    public $form;

    public function save()
    {
        dump('test');
    }

    public function render()
    {
        return view('livewire.sales.sales-form');
    }
}
