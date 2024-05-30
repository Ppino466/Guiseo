<?php

namespace App\Http\Livewire\Sale;

use App\Exports\SalesExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SalesTable extends DataTableComponent
{
    public function builder(): Builder
    {
    return Sale::query()
    ->latest();
    }

   /*  public function download($value)
    {
        // Convertir value a array si no lo es
        $saleIds = is_array($value) ? $value : [$value];
    
        // Crear una instancia del exportador con los IDs de venta
        $export = new SalesExport($saleIds);
    
        // Exportar a Excel
        return Excel::download($export, 'Venta_' . now() . '.xlsx');
    } */

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

    public function query($saleId)
    {
        // Asegúrate de que $saleId sea un entero
        if (!is_numeric($saleId)) {
            // Manejar el caso donde el ID de venta no es un número válido
            abort(400, 'ID de venta no válido');
        }
    
        return SaleDetail::where('sale_id', $saleId)
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->select([
                'sale_details.id',
                'sale_details.sale_id',
                'sale_details.product_id', 
                'products.name as product_name', 
                'products.sku as product_sku', 
                'sale_details.quantity',
                DB::raw("CONCAT('$', FORMAT(sale_details.unit_price, 2)) AS unit_price"),
                'sale_details.total_price',
                DB::raw("DATE_FORMAT(sale_details.updated_at, '%d/%m/%Y') as formatted_updated_at"),
                'users.name as user_name'
            ])->get();
    }
    
    
    
    

    public function download($id)
    {
        //Carga en base 64 Isotipo
        $path = 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $Isotipo = 'data:image/' . $type . ';base64,' . base64_encode($data);
    
        $saleDetail = $this->query($id);
        
        if (!$saleDetail) {
            // Manejar el caso donde no se encuentra el detalle de venta
            abort(404, 'Detalle de venta no encontrado');
        }
    
        $dompdf = new Dompdf();
        $html = View::make('pdf.detail_sale', compact('saleDetail', 'Isotipo'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
    
        return response()->streamDownload(function () use ($dompdf) {
            echo $dompdf->output();
        }, 'venta.pdf');
    }
    
}
