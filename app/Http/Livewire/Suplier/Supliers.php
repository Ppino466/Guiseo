<?php

namespace App\Http\Livewire\Suplier;

use App\Models\Supplier;
use Livewire\Component;
use App\Notifications\WelcomeNotification;

class Supliers extends Component
{
    public $suplier;

    public $name, $contact_name, $address,$phone, $email;

    protected $listeners = ['editSuplier' => 'editSuplier','downSuplier' => 'downSuplier','upSuplier'=> 'upSuplier'];

    public function editSuplier($suplierId)
    {

        if ($suplierId) {
            $this->suplier = Supplier::find($suplierId);
            $this->name = $this->suplier->name;
            $this->contact_name = $this->suplier->contact_name;
            $this->address= $this->suplier->address;
            $this->phone = $this->suplier->phone;
            $this->email = $this->suplier->email;
        } else {
            $this->name = '';
            $this->contact_name = '';
            $this->address = '';
            $this->phone = '';
            $this->email = '';
        }
    }

    public function updateSuplier()
    {
        $this->validate([
            'name' => 'required',
            'contact_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        if ($this->suplier) {
            $this->suplier->name = $this->name;
            $this->suplier->contact_name = $this->contact_name;
            $this->suplier->address = $this ->address;
            $this->suplier->phone = $this->phone;
            $this->suplier->email = $this->email;
            $this->suplier->save();

            // Emitir evento para notificar que la actualización fue exitosa
            $this->emit('suplierUpdated');
            $this->emit('refreshDatatable');
        }
    }

    public function saveSuplier()
    {
        // Validar y registrar al nuevo usuario
        $suplier= Supplier::create([
            'name' => $this->name,
            'contact_name' => $this->contact_name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $this->emit('suplierUpdated');
        $this->emit('refreshDatatable');
    }

    public function downsuplier($suplierId)
    {
        // Buscar al usuario por su ID
        $suplier= Supplier::find($suplierId);

        // Verificar si el usuario existe y cambiar su estado
        if ($suplier) {
            $suplier->status = false; // Cambiar el estado a inactivo
            $suplier->save();
            $this->emit('refreshDatatable');
        }
    }

    public function upsuplier($suplierId)
    {
        
        // Buscar al usuario por su ID
        $suplier= Supplier::find($suplierId);

        // Verificar si el usuario existe y cambiar su estado
        if ($suplier) {
            $suplier->status = true; // Cambiar el estado a activo
            $suplier->save();
            $this->emit('refreshDatatable');
        }
    }

    public function render()
    {
        return view('livewire.Suplier.supliers');
    }
}
