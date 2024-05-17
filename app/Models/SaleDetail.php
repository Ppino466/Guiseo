<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SaleDetail extends Model
{
    use LogsActivity;

    protected $table = 'sale_details';

    protected $fillable = [
        'sale_id', 
        'product_id', 
        'quantity', 
        'unit_price',
        'total_price'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
       
    }
}
