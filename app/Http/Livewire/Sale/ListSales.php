<?php

namespace App\Http\Livewire\Sale;

use App\Models\Sale;
use App\Models\SaleDetail;
use Livewire\Component;

class ListSales extends Component
{

    protected $listeners = ['showDetail'];

    public $data =[];

    public $latestDate;

    public $userName;

    public $totalSale;

    public function render()
    {
        return view('livewire.sale.list-sales');
    }

    public function showDetail($id)
    {
        $this->data = SaleDetail::with('product')
                                ->where('sale_id', $id)
                                ->get();
    
        // Obtener la fecha más reciente
        $this->latestDate = $this->data->max('created_at');
    
        // Obtener la venta y el nombre del usuario
        $sale = Sale::with('user')->find($id);
    
        // Asegúrate de que la venta existe y tiene un usuario asociado
        $this->userName = $sale && $sale->user ? $sale->user->name : null;

        $this->totalSale = $this->data->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });
    }
}
