<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Supplier extends Model
{
    use LogsActivity;
    
    protected $table = 'suppliers';

    protected $fillable = [
        'name', 
        'contact_name', 
        'address', 
        'phone',
        'email'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
       
    }
}
