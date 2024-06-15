<?php

namespace App\Http\Livewire\Goal;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use App\Models\Goal;
use App\Models\User;
use Carbon\Carbon;


class GoalTable extends DataTableComponent
{
    protected $model = Goal::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Empleado", "user_id")
                ->sortable()
                ->format(function ($value) {
                    if ($value) {
                        $data = User::find($value);

                        if ($data) {
                            $value = $data->name;
                        } else {
                            // Valor a devolver si no se encuentra el ID del departamento
                            $value = "N/A";
                        }
                    }

                    return $value;
                }),
            Column::make("Type", "type")
                ->sortable(),
            Column::make("Amount", "amount")
                ->sortable()
                ->format(function ($value) {
                    // Formatear el valor agregando el signo $
                    return '$'  . number_format($value, 2);
                }),
            Column::make("Start date", "start_date")
                ->sortable(),
            Column::make("End date", "end_date")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable()
                ->format(function ($value) {
                    $statusLabels = [
                        'active' => '<span class="text-info font-weight-bold text-capitalize">active</span>',
                        'completed' => '<span class="text-success font-weight-bold text-capitalize">completed</span>',
                        'pending' => '<span class="text-warning font-weight-bold text-capitalize">pending</span>',
                    ];

                    return $statusLabels[$value] ?? $value;
                })

                ->html(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Fecha asignación", "created_at")
                ->sortable(),
            Column::make("Ultima modificación", "updated_at")
                ->sortable()
                ->format(function ($value) {
                    return ucfirst(Carbon::parse($value)->diffForHumans());
                }),
                Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    $buttons = [
                        'edit' => '<a wire:click="$emit(\'modalOpen\',' . $value . ')" class="btn btn-success"><i class="material-icons opacity-10">edit</i></a>',
                        'delete' => '<a wire:click="$emit(\'listenerDelete\',' . $value .')" class="btn btn-danger"><i class="material-icons opacity-10">close</i></a>',
                        'activate' => '<a wire:click="$emit(\'listenerActivate\',' . $value . ')" class="btn btn-info"><i class="material-icons opacity-10">check</i></a>',
                    ];
            
                    
                    $statusButtons = [
                        'pending' => $buttons['delete'],
                        'active' => $buttons['activate'],
                    ];
            
                    if ($row->status === 'completed') {
                        $actions = '<div class="btn-group">' .
                            ($statusButtons[$row->status] ?? '') .
                            '</div>';
                    } else {
                        $actions = '<div class="btn-group">' .
                            $buttons['edit'] .
                            ($statusButtons[$row->status] ?? '') .
                            '</div>';
                    }
            
                    return $actions;
                })
                ->html(),            

        ];
    }
}
