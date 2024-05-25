<?php

namespace App\Http\Livewire\Sale;

use App\Exports\SalesExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class SalesTable extends DataTableComponent
{
    public function builder(): Builder
    {
    return Sale::query()
    ->latest();
    }

    public function download()
    {
        
        return Excel::download(new SalesExport, 'Venta_'.now(). '.xlsx');
    }

    public function filters(): array
{
    return [
        DateFilter::make('Fecha')
            ->filter(function(Builder $builder, string $value) {
                $builder->where('created_at','>=', $value);
            }),
            TextFilter::make('Nombre')
            ->config([
                'placeholder' => 'Buscar nombre',
                'maxlength' => '25',
            ])
            ->filter(function(Builder $builder, string $value) {
                // Busca el user_id correspondiente al nombre del usuario
                $user = User::where('name', 'like', '%' . $value . '%')->first();
        
                if ($user) {
                    // Si se encuentra el usuario, filtra las ventas por el user_id encontrado
                    $builder->where('sales.user_id', $user->id);
                } else {
                    // Si no se encuentra el usuario, puede que quieras filtrar para que no devuelva resultados
                    $builder->whereNull('sales.user_id');
                }
            }),
    ];
}

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
        $this->setPaginationStatus(false);
        $this->setColumnSelectDisabled();
        $this->setEmptyMessage('Nada capturado');
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
            Column::make("Total", "total")
                ->sortable()
                ->format(function ($value) {
                    // Formatear el valor agregando el signo $
                    return '$'  . number_format($value, 2);
                }),
           
            Column::make("Capturada", "created_at")
                ->sortable()
                ->format(function($value) {
                    return ucfirst(Carbon::parse($value)->toDateTimeString());
                }),
                Column::make('Acciones', 'id')->format(function ($value, $row, Column $column) {
                    $boton = '<button type="button" wire:click="$emit(\'modalOpen\', ' . $value . ')" class="btn btn-info">
                                <i class="material-icons opacity-10">preview</i>
                              </button>';
                
                    return '<div class="btn-group">' .$boton . '<button type="button" wire:click="download('.$value.')" class="btn btn-success">
                    <i class="material-icons opacity-10">list_alt</i>
                  </button>';
                })->html(),
                

        ];
    }
}
