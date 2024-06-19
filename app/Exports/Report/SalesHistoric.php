<?php

namespace App\Exports\Report;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalesHistoric implements FromQuery,WithHeadings,WithStyles
{
    use Exportable;

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

    public function headings(): array
    {
        return [
            'Id',
            'Usuario',
            'Total',
            'Fecha',
        ];
    }

    public function query()
    {
      
        
        return Sale::query()
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->select([
                'sales.id',
                'users.name',
                DB::raw("CONCAT('$', FORMAT(sales.total, 2)) AS formatted_total"),
                DB::raw("DATE_FORMAT(sales.created_at, '%d/%m/%Y %H:%i:%s') as formatted_created_at")
            ])
            ->orderBy('sales.created_at', 'desc');
    }
}
