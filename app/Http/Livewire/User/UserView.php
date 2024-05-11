<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;


class UserView extends Component
{
    protected $listeners = ['deleteUser'];

    public $user;

    public function mount($id)
    {
        // Obtener el usuario por su ID
        $this->user = User::find($id);

    }


    public function render()
{
    return view('livewire.users.user-view', [
        'user' => $this->user
    ]);
}

public function confirmDelete()
{

    $this->emit('confirmDelete');

}

public function deleteUser()  {
    // Elimina el usuario de la base de datos
    $this->user->delete();

    // Emitir un evento para indicar que el usuario ha sido eliminado
    $this->emit('userDeleted');
    
    return redirect('/sign-in');
}
}
