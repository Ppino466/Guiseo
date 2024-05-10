<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{

    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'

    ];

    public function messages(): array
    {
        return [

            'email.required' => 'El correo es requerido',
            'password.required' => 'La contraseña es requerida',
        ];
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function mount()
    {
        $user = User::find(1);
        if ($user) {
            $this->email = $user->email;
        } else {
            $this->email = '';
        }
    }

    public function store()
    {
        $attributes = $this->validate();

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();

        return redirect('/dashboard');

    }
}
