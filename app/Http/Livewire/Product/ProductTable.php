<?php

namespace App\Http\Livewire\User;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;


class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
        $this->setPaginationStatus(false);

    }

    public function columns(): array
    {
        return [
          
            Column::make("Id","id"),
            Column::make("Nombre", "name"),

                Column::make("Apellido", "last_name"),
            Column::make("Teléfono", "phone"),
            Column::make("Correo","email"),
            Column::make("Puesto", "about"),
            BooleanColumn::make("Estatus","status"),    
            Column::make("Fecha registro", "created_at")
            ->format(function($value) {
                return ucfirst(Carbon::parse($value)->diffForHumans());
            }),
            Column::make("Ultima modificación", "updated_at")
            ->format(function($value) {
                return ucfirst(Carbon::parse($value)->diffForHumans());
            }),    
            Column::make('Acciones', 'id')
            ->format(function ($value, $row, Column $column) {
                $botones = [
                    'editar' => '<a wire:click="$emit(\'modalOpen\',' . $value . ')" class="btn btn-success"><i class="material-icons opacity-10">edit</i></a>',
                    'baja' => '<a wire:click="$emit(\'listenerBaja\',' . $value .')" class="btn btn-danger"><i class="material-icons opacity-10">close</i></a>',
                    'alta' => '<a wire:click="$emit(\'listenerAlta\',' . $value . ')" class="btn btn-info"><i class="material-icons opacity-10">check</i></a>',
                ];

                $botonesStatus = [
                    1 => $botones['baja'] , 
                    0 => $botones['alta'] , 
                ];

                return '<div class="btn-group">' .
                    $botones['editar'] .
                    ($botonesStatus[$row->status] ?? '') .
                    '</div>';
            })
            ->html(),     
        ];
    }
}
