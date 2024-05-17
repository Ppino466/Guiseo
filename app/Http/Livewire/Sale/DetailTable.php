<?php

namespace App\Http\Livewire\Sale;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SaleDetail;

class DetailTable extends DataTableComponent
{
    protected $model = SaleDetail::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
        $this->setPaginationStatus(false);
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Product id", "product_id"),
            Column::make("Quantity", "quantity"),
            Column::make("Unit price", "unit_price"),
            Column::make("Total price", "total_price"),
            ];
    }
}
