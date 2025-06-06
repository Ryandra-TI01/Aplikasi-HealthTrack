<?php

namespace App\Livewire\Auth;

use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormLogin extends Component
{
    #[Validate('required|email')]
    public $email = '';
    #[Validate('required')]
    public $password = '';
    public $remember = false;

    public function login()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('filament.admin.pages.dashboard');
            }
            return redirect()->route('dashboard');
        }

        $this->addError('email', 'These credentials do not match our records. Please try again.');
    }

    public function render()
    {
        return view('livewire.auth.form-login');
    }
}
