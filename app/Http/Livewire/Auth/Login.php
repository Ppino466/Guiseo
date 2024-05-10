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
        // Validar los campos del formulario
        $attributes = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'No se pudieron verificar las credenciales proporcionadas.'
            ]);
        }

        // Obtener al usuario autenticado
        $user = auth()->user();

        // Verificar el estado del usuario
        if (!$user->status) {
            throw ValidationException::withMessages([
                'email' => 'Su cuenta está inactiva. Comuníquese con el soporte para obtener ayuda.'
            ]);
        }

        // Regenerar la sesión
        session()->regenerate();

        // Redireccionar al dashboard
        return redirect('/dashboard');
    }
}
