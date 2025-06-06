<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Auth;
use Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormRegister extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|unique:users,email')]
    public string $email = '';

    #[Validate('required|min:5|same:passwordConfirmation')]
    public string $password = '';

    public string $passwordConfirmation = '';
    #[Validate('accepted')]
    public bool $terms = false;

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('user');

        Auth::login($user);

        session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.form-register');
    }
}
