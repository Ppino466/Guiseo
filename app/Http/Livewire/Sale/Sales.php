<?php

namespace App\Http\Livewire\Sale;

use App\Models\Inventory;
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
        $this->listProducts = Product::whereHas('inventory', function ($query) {
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
            $inventory = Inventory::where('product_id', $row->product_id)->first();
            if ($inventory) {
                $inventory->update([
                    'quantity' => $inventory->quantity + $row->quantity
                ]);
            }
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
    
            $saleDetails = SaleDetail::where('sale_id', $sale->id)->get();
    
            // Devolver la cantidad de cada producto al inventario
            foreach ($saleDetails as $detail) {
                $inventory = Inventory::where('product_id', $detail->product_id)->first();
                if ($inventory) {
                    $inventory->update([
                        'quantity' => $inventory->quantity + $detail->quantity
                    ]);
                }
            }
    
            // Eliminar los detalles de la venta
            SaleDetail::where('sale_id', $sale->id)->delete();
    
            // Eliminar la venta
            $sale->delete();
    
            // Emitir evento para refrescar el datatable
            $this->emit('refreshDatatable');
            $this->quantity = '';
        } else {
            // Emitir evento si no se encuentra la venta
            $this->emit('saleNotFound');
        }
    }
    

    public function addDetail()
    {
        $this->validate([
            'name' => 'required',
            'quantity' => 'required|integer|min:1'

        ]);

        // Obtener el producto seleccionado
        $inventory = Inventory::where('product_id', $this->selectedProduct->id)->first();

        // Verificar si hay suficiente cantidad en el inventario
        if ($this->quantity > $inventory->quantity) {
            // Emitir un evento indicando que la cantidad supera la disponible
            $this->emit('quantityExceeded');
            return;
        }

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

        // Reducir la cantidad del inventario
        $inventory->update([
            'quantity' => $inventory->quantity - $this->quantity
        ]);

        $this->emit('refreshDatatable');
        $this->quantity = '';
    }

    public function render()
    {
        return view('livewire.sale.sales');
    }
}
