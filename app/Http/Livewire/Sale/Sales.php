<?php

namespace App\Http\Livewire\Sale;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Livewire\Component;

class Sales extends Component
{
    public $listProducts;

    public $productId;
    public $quantity;
    public $unitPrice;
    public $totalPrice;
    public $selectedProduct;
    public $name;

    public $sale;

    protected $listeners = ['productSelected' => 'searchProduct', 'downSale'];

    public function messages(): array
    {
        return [

            'name.required' => 'El producto es requerido',
            'quantity.required' => 'La cantidad es requerida',
        ];
    }

    public function mount()
    {
        $this->selectedProduct = null;
        $this->listProducts = Product::whereHas('inventory', function($query) {
            $query->where('quantity', '>', 0);
        })->get();
    }

    public function searchProduct($selectedValue)
    {
        $this->selectedProduct = Product::find($selectedValue);
        $this->name = $this->selectedProduct->name;
        $this->unitPrice = '$' . $this->selectedProduct->price;
    }

    public function downSale($id)
    {
        $row = SaleDetail::find($id);

        if ($row) {
            $row->delete();
        }
        $this->emit('refreshDatatable');
    }

    public function completedSale()
{
    $sale = Sale::where('user_id', auth()->user()->id)
                ->where('status', false)
                ->first();

    if ($sale) {
        $sale->update(['status' => true]);
        $this->emit('refreshDatatable');
        $this->quantity = '';
    } else {
        $this->emit('saleNotFound'); 
    }
}

public function rejectSale()
{
    $sale = Sale::where('user_id', auth()->user()->id)
                ->where('status', false)
                ->first();

    if ($sale) {
        $sale->delete();
        $this->emit('refreshDatatable');
        $this->quantity = '';
    } else {
        $this->emit('saleNotFound'); 
    }
}

    public function addDetail()
    {
        $this->validate([
            'name' => 'required',
            'quantity' => 'required'

        ]);
        $sale = Sale::where('user_id', auth()->user()->id)
            ->where('status', false)
            ->first();

        // Si no hay una venta existente, crea una nueva
        if (!$sale) {
            $sale = Sale::create([
                'user_id' => auth()->user()->id,
                'total' => 0
            ]);
        }

        $existingDetail = SaleDetail::where('sale_id', $sale->id)
            ->where('product_id', $this->selectedProduct->id)
            ->first();
        // Calcular el total del detalle
        $totalPrice = $this->quantity * str_replace('$', '', $this->unitPrice);

        if ($existingDetail) {
            $existingDetail->update([
                'quantity' => $existingDetail->quantity + $this->quantity,
                'total_price' => $existingDetail->total_price +  $totalPrice
            ]);
        } else {
            // Si no existe un detalle para el producto seleccionado, crear uno nuevo
            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $this->selectedProduct->id,
                'quantity' => $this->quantity,
                'unit_price' => str_replace('$', '', $this->unitPrice),
                'total_price' =>  $totalPrice
            ]);
        }

        $sale->update([
            'total' => $sale->total + $totalPrice
        ]);

        $this->emit('refreshDatatable');
        $this->quantity = '';
    }

    public function render()
    {
        return view('livewire.sale.sales');
    }
}
