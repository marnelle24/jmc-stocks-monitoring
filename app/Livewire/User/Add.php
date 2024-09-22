<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Add extends Component
{
    public $roles = [];
    public $selectedRoles = [];
    public $name = '';
    public $username = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function mount()
    {
        $this->roles = Role::all()->pluck('name');
    }

    public function submit()
    {
        $validatedData = $this->validate();

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $user->syncRoles($this->selectedRoles);

        session()->flash('message', 'User successfully created.');

        // Optionally, reset form fields
        // $this->reset(['name', 'username', 'email', 'password', 'password_confirmation']);
        return redirect()->to('/users');
    }

    public function render()
    {
        return view('livewire.user.add');
    }
}
