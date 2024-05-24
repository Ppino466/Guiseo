<?php

namespace App\Exports;

use App\Models\SaleDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       /*  $data = SaleDetail::with('product')
        ->where('sale_id', $id)
        ->get();
        dd($data); */
        return SaleDetail::all();
    }
}
