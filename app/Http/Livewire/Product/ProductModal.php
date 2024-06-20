<?php

namespace App\Http\Livewire\Product;

use App\Http\Livewire\Product\Product as ProductProduct;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Supplier;
use App\Models\Categorie;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;


class ProductModal extends Component
{
    use WithFileUploads;

    public $product, $Inventory;

    public $listSuppliers, $selectedSupplier, $supplierId;

    public $listCategories, $selectedCategory, $categoryId;

    public $name, $description, $price, $sku, $image, $imagePath;

    public $productId, $quantity, $location, $entryDate, $minQuantity, $maxQuantity, $status;

    public $currentStep = 1;

    protected $listeners = ['editProduct' => 'editProduct'];

    public function increaseStep()
    {
        // Función para validar paso a paso
        $this->validateData();
        $this->currentStep++;
    }

    public function decreaseStep()
    {
        $this->currentStep--;
    }

    public function mount()
    {
        $this->selectedSupplier = null;
        // $this->listSuppliers = Product::whereHas('inventory', function($query) {
        //     $query->where('quantity', '>', 0);
        // })->get();
        //$this->listSuppliers = DB::table('suppliers')->select('id','name')->get();
        //dd($this->listSuppliers);
        $this->listSuppliers = Supplier::all();

        $this->selectedCategory = null;
        $this->listCategories = Categorie::all();
    }

    public function validateData()
    {

        if ($this->currentStep == 1) {
            $this->validate([
                'supplierId' => 'required|integer'
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'categoryId' => 'required|integer',
                //'sku' => 'required|string|unique:products,sku',
                'sku' => 'required|string',
              
            ]);
        } elseif (!$this->productId) {
                $this->validate(['image' => 'required|image|max:2048']); //Tamaño de carga very importante
        }
    }

    //Función para cargar los datos de un producto por editar
    public function editProduct($productId)
    {
        $this->productId = $productId;
        if ($this->productId) {
            //Datos producto
            $this->product = Product::with('inventory')->find($productId);
            $this->name = $this->product->name;
            $this->description = $this->product->description;
            $this->price = $this->product->price;
            //Combos
            $this->supplierId = $this->product->supplier_id;
            $this->categoryId = $this->product->category_id;
            $this->sku = $this->product->sku;
            // $this->image = $this->product->image;

            //Datos inventario
            if ($this->product) {
                $this->Inventory = $this->product->inventory;
                $this->location = $this->Inventory->location;
                $this->quantity = $this->Inventory->quantity;
                //Fecha
                $this->entryDate = $this->Inventory->entry_date;
                $this->minQuantity = $this->Inventory->min_quantity;
                $this->maxQuantity = $this->Inventory->max_quantity;
                //Combo
                $this->status = $this->Inventory->status;
            }
        } else {
            $this->name = '';
            $this->description = '';
            $this->price = '';
            //Combos
            $this->supplierId = '';
            $this->categoryId = '';
            $this->sku = '';
            $this->image = '';
            $this->location = '';
            $this->quantity = '';
            //Fecha
            $this->entryDate = '';
            $this->minQuantity = '';
            $this->maxQuantity = '';
            //Combo
            $this->status = '';
            $this->image = '';
        }
        $this->emit('ok');
    }

    //Función para crear o editar los productos
    public function saveOrUpdateProduct()
{

    if ($this->product) {
        // Actualizar datos del producto
        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'supplier_id' => $this->supplierId,
            'category_id' => $this->categoryId,
            'sku' => $this->sku,
        ]);

        // Actualizar datos de inventario
        $this->product->inventory->update([
            'location' => $this->location,
            'quantity' => $this->quantity,
            'entry_date' => $this->entryDate,
            'min_quantity' => $this->minQuantity,
            'max_quantity' => $this->maxQuantity,
            'status' => $this->status,
        ]);

        $product = $this->product;

        //Reseteamos los stemps
        $this->currentStep = 1;
        
        $this->emit('productUpdated');

    } else {
        // Crear nuevo producto
        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'supplier_id' => $this->supplierId,
            'category_id' => $this->categoryId,
            'sku' => $this->sku,
        ]);

        // Crear inventario
        $product->inventory()->create([
            'location' => $this->location,
            'quantity' => $this->quantity,
            'entry_date' => $this->entryDate,
            'min_quantity' => $this->minQuantity,
            'max_quantity' => $this->maxQuantity,
            'status' => $this->status,
        ]);

        $this->emit('productCreated');
        
        //Reseteamos los stemps
        $this->currentStep = 1;
    }

    // Guardar imagen con el ID del producto
    if ($this->image) {
        $this->imagePath = $this->image->storeAs('product-images', $product->id . '.' . $this->image->extension(), 'public');
        $product->update(['image' => $this->imagePath]);
    } 

      //Guardado de imagen
        //$this->imagePath = $this->image->store('product-images', 'public');

    // Emitir evento para refrescar la tabla de proveedores
    $this->emit('refreshDatatable');
}


    public function render()
    {
        return view('livewire.product.product-modal');
    }
}
