<?php

namespace App\Http\Livewire\Suplier;

use App\Models\Supplier;
use Livewire\Component;

class SuplierModal extends Component
{

    public $suplier;

    public $suplierId;

    public $name, $contact_name, $address, $phone, $email;

    protected $listeners = ['editSuplier' => 'editSuplier', 'downSuplier' => 'downSuplier', 'upSuplier' => 'upSuplier'];

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'contact_name.required' => 'El apellido es requerido',
            'address.required' => 'El apellido es requerido',
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo electrónico debe ser válido',
            'phone.required' => 'El teléfono es requerido',
        ];
    }

    public function saveOrUpdateSuplier()
    {
        $this->validate([
            'name' => 'required',
            'contact_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        if ($this->suplier) {
            $this->suplier->name = $this->name;
            $this->suplier->contact_name = $this->contact_name;
            $this->suplier->address = $this->address;
            $this->suplier->phone = $this->phone;
            $this->suplier->email = $this->email;
            $this->suplier->save();

            // Emitir evento para notificar que la actualización fue exitosa
            $this->emit('suplierUpdated');
        } else {
            // Si no existe el proveedor, lo creamos
            $suplier = Supplier::create([
                'name' => $this->name,
                'contact_name' => $this->contact_name,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
            ]);

            // Emitir evento para notificar que se ha creado un nuevo proveedor
            $this->emit('suplierCreated');
        } 
        
        // Emitir evento para refrescar la tabla de proveedores
        $this->emit('refreshDatatable');
    }

    public function editSuplier($suplierId)
    {

        $this->suplierId = $suplierId;
        if ($this->suplierId) {
            $this->suplier = Supplier::find($suplierId);
            $this->name = $this->suplier->name;
            $this->contact_name = $this->suplier->contact_name;
            $this->address = $this->suplier->address;
            $this->phone = $this->suplier->phone;
            $this->email = $this->suplier->email;
        } else {
            $this->suplierId = '';
            $this->name = '';
            $this->contact_name = '';
            $this->address = '';
            $this->phone = '';
            $this->email = '';
        }

        $this->emit('ok');
    }

    public function downSuplier($suplierId)
    {
        $suplier = Supplier::findOrFail($suplierId);

        if ($suplier) {
            $suplier->status = false;
            $suplier->save();
            $this->emit('refreshDatatable');
        }
    }

    public function upSuplier($suplierId)
    {
        $suplier = Supplier::findOrFail($suplierId);

        if ($suplier) {
            $suplier->status = true;
            $suplier->save();
            $this->emit('refreshDatatable');
        }
    }

    public function render()
    {
        return view('livewire.suplier.suplier-modal');
    }
}
