<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Livewire\Component;

class UserModal extends Component
{

    public $user;

    public $name, $lastName, $phone, $email;

    protected $listeners = ['editUser' => 'editUser','downUser' => 'downUser','upUser'=> 'upUser'];


    public function messages(): array
{
    return [
        'name.required' => 'El nombre es requerido',
        'lastName.required' => 'El apellido es requerido',
        'email.required' => 'El correo es requerido',
        'email.email' => 'El correo electrónico debe ser válido', 
        'phone.required' => 'El teléfono es requerido',
    ];
}


public function saveOrUpdateUser()
{
    $this->validate([
        'name' => 'required',
        'lastName' => 'required',
        'email' => 'required|email',
        'phone' => 'required'
    ]);

    if ($this->user) {
        // Si existe el usuario, actualizamos sus datos
        $this->user->name = $this->name;
        $this->user->last_name = $this->lastName;
        $this->user->phone = $this->phone;
        $this->user->email = $this->email;
        $this->user->save();

        // Emitir evento para notificar que la actualización fue exitosa
        $this->emit('userUpdated');
    } else {
        // Si no existe el usuario, lo creamos
        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => '123456789',
            'location' => 'gdl',
            'about' => 'vendedor',
            'status' => true
        ]);

        //Asignamos el rol de vendedor
        $user->assignRole('Vendedor');

        // Enviar la notificación de bienvenida con la contraseña generada
        $user->notify(new WelcomeNotification(123456789));

        // Emitir evento para notificar que se ha creado un nuevo usuario
        $this->emit('userCreated');
    }

    // Emitir evento para refrescar la tabla de usuarios
    $this->emit('refreshDatatable');
}


    public function editUser($userId)
    {
        if ($userId) {
            $this->user = User::find($userId);
            $this->name = $this->user->name;
            $this->lastName = $this->user->last_name;
            $this->phone = $this->user->phone;
            $this->email = $this->user->email;
        } else {
            $this->user = "";
            $this->name = '';
            $this->lastName = '';
            $this->phone = '';
            $this->email = '';
        }

        $this->emit('ok');
    }

    public function downUser($userId)
    {
        // Buscar al usuario por su ID
        $user = User::find($userId);

        // Verificar si el usuario existe y cambiar su estado
        if ($user) {
            $user->status = false; // Cambiar el estado a inactivo
            $user->save();
            $this->emit('refreshDatatable');
        }
    }

    public function upUser($userId)
    {
        // Buscar al usuario por su ID
        $user = User::find($userId);

        // Verificar si el usuario existe y cambiar su estado
        if ($user) {
            $user->status = true; // Cambiar el estado a activo
            $user->save();
            $this->emit('refreshDatatable');
        }
    }

    public function render()
    {
        return view('livewire.users.user-modal');
    }
}
