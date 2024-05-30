<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

class ProductModal extends Component
{
    public $product;

 
    public $currentStep = 1;


    public function increaseStep(){
       
        // Función para validar paso a paso $this->validateData();
        $this->currentStep++;
       
    }

    public function decreaseStep(){
        $this->currentStep--;
    
    }

   /*  public function validateData(){

        if($this->currentStep == 1){
            $this->validate([
              //Campos paso 1
            ]);
        }
        elseif($this->currentStep == 2){
              $this->validate([
                 //Campos paso 2'
              ]);
        }
        elseif($this->currentStep == 3){
              $this->validate([
                  //Campos paso 3
              ]);
        }
    } */


    //Aqui la función para guardar cambios en losk productos
/*     public function saveOrUpdateUser()
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
            'about' => 'empleado',
            'status' => true
        ]);

      

        // Emitir evento para notificar que se ha creado un nuevo usuario
        $this->emit('userCreated');
    }

    // Emitir evento para refrescar la tabla de usuarios
    $this->emit('refreshDatatable');
} */

    public function render()
    {
        return view('livewire.product.product-modal');
    }
}
