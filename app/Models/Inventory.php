<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Inventory extends Model
{
    use LogsActivity;

    protected $table = 'inventory';

    use HasFactory;

    protected $fillable = [
        'product_id',
        'location',
        'quantity',
        'entry_date',
        'min_quantity',
        'max_quantity',
        'status',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);

    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
