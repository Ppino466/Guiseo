<?php

namespace App\Exports;

use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
class SalesExport implements FromQuery,WithHeadings, WithStyles
{

    use Exportable;

    public $sale;

    public function __construct(array $sale) 
    {
    
        $this->sale = $sale;
    
    }

    public function headings():array {
    
        return [
            'Id',
            'Id venta',
            'Id producto',
            'Cantidad',
            'Precio unitario',
            'Total',
            'Fecha Registro'
        ];
      }

    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la primera fila de encabezados
            1    => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FFFFFFFF'], // Texto blanco
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '004F9F', // ARGB color code para azul
                    ],
                ],
            ],
        ];
    }

    public function query()
    {
        if (!empty($this->sale)) {
            return SaleDetail::whereIn('id', $this->sale)
                ->select([
                    'id',
                    'sale_id',
                    'product_id', 
                    'quantity',
                    DB::raw("CONCAT('$', FORMAT(unit_price, 2)) AS unit_price"),
                    'total_price',
                    DB::raw("DATE_FORMAT(updated_at, '%d/%m/%Y') as formatted_updated_at")
                ]);
        }
    }
    
}
