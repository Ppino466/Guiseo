<?php

namespace App\Http\Livewire\Sale;

use App\Models\Product;
use App\Models\Sale;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Builder;

class DetailTable extends DataTableComponent
{
    

    public function builder(): Builder
    {
        return SaleDetail::whereHas('sale', function ($query) {
            $query->where('user_id', auth()->user()->id)
                  ->where('status', false);
        });
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

            Column::make("Nombre", "product_id")
            ->format(function ($value) {
                if ($value) {
                    $data = Product::find($value);
                    
                    if ($data) {
                        $value = $data->name;
                    } else {
               
                        $value = "SKU no encontrado";
                    }
                }
        
                return $value;
            }),
            Column::make("Quantity", "quantity"),
            Column::make("Unit price", "unit_price")
            ->format(function ($value) {
                // Formatear el valor agregando el signo $
                return '$'  . number_format($value, 2);
            }),
            Column::make("Total price", "total_price")
            ->format(function ($value) {
                // Formatear el valor agregando el signo $
                return '$'  . number_format($value, 2);
            })
            ->footer(function($rows) {
                return 'Subtotal: '.'$' . number_format ($rows->sum('total_price'),2);
            }),  
            Column::make('Acciones', 'id')->format(function ($value, $row, Column $column) {
                $boton = '<a wire:click="$emit(\'listenerBorrar\',' . $value .')" class="btn btn-danger"><i class="material-icons opacity-10">delete</i></a>';
            
                return $boton;
            })->html(),
            
        ];
    }
}
