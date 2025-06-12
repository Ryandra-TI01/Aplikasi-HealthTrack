<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormLogin extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public $remember = false;

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();

            $user = Auth::user();

            // Jika user punya 2FA aktif
            if (
                Features::enabled(Features::twoFactorAuthentication()) &&
                $user->two_factor_secret &&
                !session()->get('auth.2fa_passed')
            ) {
                // logout dulu sementara
                Auth::logout();

                // simpan ID user untuk validasi 2FA di Fortify
                session(['login.id' => $user->getAuthIdentifier()]);

                // redirect ke halaman Jetstream 2FA
                return redirect()->route('two-factor.login');
            }

            // Kalau tidak pakai 2FA atau sudah lolos, redirect ke dashboard
            return redirect()->intended(route('dashboard'));
        }

        $this->addError('email', 'These credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.form-login');
    }
}
