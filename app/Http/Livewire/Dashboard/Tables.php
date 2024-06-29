<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Tables extends Component
{
    public $categories;
    public $users;
    public $invetory;
    public $month;
    public $totalInventoryCost;
    public $inventoryLevel;
    public $mostSoldProduct;
    public $leastSoldProduct;
    public $alertsStock;
    public $totalSaleUser = [];
    public $totalSaleCategory =[];

    public function mount()
    {
        $this->initializeData();
    }


    public function getSalesByCategory()
    {
        $startOfMonth = now()->startOfMonth()->toDateString();  
        $endOfMonth = now()->endOfMonth()->toDateString();     
    
        $this->totalSaleCategory = DB::table('sale_details')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->whereBetween('sales.created_at', [$startOfMonth, $endOfMonth]) 
            ->select(
                'categories.name as category_name',
                DB::raw('SUM(sale_details.unit_price * sale_details.quantity) as total_sales'),
                DB::raw("(SUM(sale_details.unit_price * sale_details.quantity) / 1000 * 100) as percentage_achieved"),
                DB::raw('SUM(sale_details.quantity) as quantity_sold')
            )
            ->groupBy('categories.name')
            ->orderByDesc('total_sales')
            ->get();
    }
    

    public function getSalesByUser()
    {
        $startOfMonth = now()->startOfMonth()->toDateString();  
        $endOfMonth = now()->endOfMonth()->toDateString();     
    
        $this->totalSaleUser = DB::table('sale_details')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->leftJoin('users', 'sales.user_id', '=', 'users.id')
            ->leftJoin('goals', function($join) {
                $join->on('users.id', '=', 'goals.user_id')
                     ->where('goals.status', '=', 'active');
            })
            ->whereBetween('sales.created_at', [$startOfMonth, $endOfMonth]) 
            ->select(
                DB::raw("CONCAT(users.name, ' ', users.last_name) as user_name"),
                DB::raw('SUM(sale_details.unit_price * sale_details.quantity) as total_sales'),
                DB::raw("(SUM(sale_details.unit_price * sale_details.quantity) / goals.amount * 100) as percentage_achieved"),
                'goals.amount as goal_amount',
                'goals.end_date as goal_end_date'
            )
            ->groupBy('users.id', 'users.name', 'users.last_name', 'goals.amount', 'goals.end_date') 
            ->having('goal_amount', '>', 0)
            ->orderByDesc('total_sales')
            ->get();
    }
    
    
    
    

    public function calculateInventoryLevel()
    {
        $this->inventoryLevel = DB::table('inventory')
            ->sum('quantity');
    }


    public function getTotalInventoryCost()
    {
        $this->totalInventoryCost = DB::table('inventory')
        ->join('products', 'inventory.product_id', '=', 'products.id')
        ->sum(DB::raw('inventory.quantity * products.price'));
    }

    public function getMostSoldProduct()
    {
        $mostSoldProduct = DB::table('sale_details')
            ->select('products.name')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->groupBy('sale_details.product_id', 'products.name')
            ->orderByDesc(DB::raw('SUM(sale_details.quantity)'))
            ->first();

        $this->mostSoldProduct = $mostSoldProduct ? $mostSoldProduct->name : null;
    }
    

    public function getLeastSoldProduct()
    {
        $leastSoldProduct = DB::table('sale_details')
            ->select('products.name')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->groupBy('sale_details.product_id', 'products.name')
            ->orderBy(DB::raw('SUM(sale_details.quantity)'))
            ->first();

        $this->leastSoldProduct = $leastSoldProduct ? $leastSoldProduct->name : null;
    }

    public function getAlertStock()
    {
        $this->alertsStock = DB::table('inventory')
            ->where('quantity', 0)
            ->count('id'); 
    }

    public function render()
    {
        return view('livewire.dashboard.tables');
    }

    public function refreshData()
    {
        // Montar de nuevo la data
        $this->initializeData();
    }

    private function initializeData()
    {
        $this->month = date('M');
        $this->getTotalInventoryCost();
        $this->calculateInventoryLevel();
        $this->getSalesByUser();
        $this->getMostSoldProduct();
        $this->getLeastSoldProduct(); 
        $this->getAlertStock();
        $this->getSalesByCategory();
        $this->getSalesByUser();
    }
    
}
