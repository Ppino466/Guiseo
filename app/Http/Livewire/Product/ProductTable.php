<?php

namespace App\Http\Livewire\Product;

use App\Models\Inventory;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;

class ProductTable extends DataTableComponent
{
    protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable(),
            Column::make("Descripción", "description")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable()
                ->format(function ($value) {
                    // Formatear el valor agregando el signo $
                    return '$'  . number_format($value, 2);
                }),
                Column::make("Cantidad", "id")
                ->sortable()
                ->format(function ($value) {
                    if ($value) {
                        $data = Inventory::find($value);
            
                        if ($data) {
                            $value = $data->quantity;
                        } 
                    }
            
                    if ($value === 0) {
                        return '<span class="text-danger">' . $value . '</span>';
                    }
            
                    return $value;
                })
                ->html(), 
                    Column::make("Ubicación", "id")
                ->sortable()
                ->format(function ($value) {
                    if ($value) {
                        $data = Inventory::find($value);
                        
                        if ($data) {
                            $value = $data->location;
                        } else {
                           
                            $value = "Sin ubicación";
                        }
                    }
               
                    return $value;
                }), 
                Column::make("Estatus", "id")
                ->sortable()
                ->format(function ($value) {
                    if ($value) {
                        $data = Inventory::find($value);
            
                        if ($data) {
                            $value = $data->status;
                        }
                    }
            
                  
                    if ($value === 'pending_restock') {
                        return '<span class="text-danger">' . $value . '</span>';
                    }
            
                    return $value;
                })
                ->html(),  
                 
            Column::make("Proveedor", "supplier_id")
                ->sortable()
                ->format(function ($value) {
                    if ($value) {
                        $data = Supplier::find($value);
                        
                        if ($data) {
                            $value = $data->name;
                        } else {
                           
                            $value = "N/A";
                        }
                    }
               
                    return $value;
                }), 
            Column::make("Categoria", "category_id")
                ->sortable(),
            Column::make("Sku", "sku")
                ->sortable(),
            Column::make("Image", "image")
                ->sortable(),
            Column::make("Registrado", "created_at")
                ->sortable()
                ->format(function($value) {
                    return ucfirst(Carbon::parse($value)->diffForHumans());
                }),
            Column::make("Modificado", "updated_at")
                ->sortable()
                ->format(function($value) {
                    return ucfirst(Carbon::parse($value)->diffForHumans());
                }),
                
                Column::make("Acciones", "id")
                ->format(function ($value, $row, Column $column) {
                    if (auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Master')) {
                    $status = Inventory::find($value)->status ?? null;
            
                    $botones = [
                        'editar' => '<a wire:click="$emit(\'modalOpen\',' . $value . ')" class="btn btn-success"><i class="material-icons opacity-10">edit</i></a>',
                        'baja' => '<a wire:click="$emit(\'listenerBaja\',' . $value . ')" class="btn btn-danger"><i class="material-icons opacity-10">close</i></a>',
                        'alta' => '<a wire:click="$emit(\'listenerAlta\',' . $value . ')" class="btn btn-info"><i class="material-icons opacity-10">check</i></a>',
                        'solicitud' => '<a wire:click="$emit(\'listenerBorrar\',' . $value . ')" class="btn btn-danger"><i class="material-icons opacity-10">delete_forever</i></a>'
                    ];
            
                    $botonesStatus = [
                        'active' => $botones['baja'],
                        'inactive' => $botones['alta'],
                        'pending_restock' => $botones['solicitud']
                    ];
            
                    return '<div class="btn-group">' .
                        $botones['editar'] .
                        ($botonesStatus[$status] ?? '') .
                        '</div>';
                    } else {
                      return   '<div><a wire:click="$emit(\'modalOpen\',' . $value . ')" class="btn btn-info"><i class="material-icons opacity-10">preview</i></a></div>';
                    }
                })
                ->html(),   

        ];
    }
}
