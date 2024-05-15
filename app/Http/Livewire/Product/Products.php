<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Livewire\Component;

class Products extends Component
{

    public $user;

    public $name, $lastName, $phone, $email;

    protected $listeners = ['editUser' => 'editUser','downUser' => 'downUser','upUser'=> 'upUser'];

    public function editUser($userId)
    {
        if ($userId) {
            $this->user = User::find($userId);
            $this->name = $this->user->name;
            $this->lastName = $this->user->last_name;
            $this->phone = $this->user->phone;
            $this->email = $this->user->email;
        } else {
            $this->name = '';
            $this->lastName = '';
            $this->phone = '';
            $this->email = '';
        }
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'lastName' => 'required',
            'phone' => 'required'
        ]);

        if ($this->user) {
            $this->user->name = $this->name;
            $this->user->last_name = $this->lastName;
            $this->user->phone = $this->phone;
            $this->user->email = $this->email;
            $this->user->save();

            // Emitir evento para notificar que la actualización fue exitosa
            $this->emit('userUpdated');
            $this->emit('refreshDatatable');
        }
    }

    public function saveUser()
    {
        // Validar y registrar al nuevo usuario
        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => '123456789',
            'location' => 'gdl',
            'about' => 'empleado',
            'status' => true
        ]);

        // Enviar la notificación de bienvenida con la contraseña generada
        $user->notify(new WelcomeNotification(123456789));
        $this->emit('userUpdated');
        $this->emit('refreshDatatable');
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
        return view('livewire.users.users');
    }
}
