<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
Use Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Component
{
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $urlID = '';

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required|min:8|same:passwordConfirmation',
    ];

    public function messages(): array
    {
        return [

            'email.required' => 'El correo es requerido',
            'password.required' => 'La contraseña es requerida',
            'min'=> 'La contraseña debe tener al menos 8 caracteres.',
            'same' => 'La contraseña y la confirmación de contraseña deben coincidir.'
        ];
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }

    public function mount($id) {
        $existingUser = User::find($id);
        $this->urlID = intval($existingUser->id);
    }

    public function update(){
        
        $this->validate(); 
          
        $existingUser = User::where('email', $this->email)->first();

        if($existingUser && $existingUser->id == $this->urlID) { 
            $existingUser->update([
                'password' => $this->password
            ]);
            redirect('sign-in')->with('status', '¡Tu contraseña ha sido restablecida!');
        } else {
            return back()->with('email', "No podemos encontrar ningún usuario con esa dirección de correo electrónico.");
        }
    
    }

}
