<?php

namespace App\Http\Livewire\Sale;

use App\Models\Product;
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
    public $price;
    

    protected $listeners = ['productSelected' => 'searchProduct'];

    public function mount()
    {
        $this->selectedProduct = null;
        $this->listProducts = Product::all();
    }

    public function searchProduct($selectedValue)
    {

        $this->selectedProduct = Product::find($selectedValue);
        $this->name = $this->selectedProduct->name;
        $this->price = '$'.$this->selectedProduct->price;
    }

    public function render()
    {
        return view('livewire.sale.sales');
    }
}
