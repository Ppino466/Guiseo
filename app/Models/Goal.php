<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Goal extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'user_id', 
        'type', 
        'amount', 
        'start_date', 
        'end_date', 
        'status', 
        'description', 
        'is_custom'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);

    }

    public static function getDefaultGoal($userId)
    {
        $defaultGoal = self::where('user_id', $userId)
            ->where('is_custom', false)
            ->first();

        if (!$defaultGoal) {
            // Create a new default goal if none exists
            $defaultGoal = self::create([
                'user_id' => $userId,
                'type' => 'Ingreso Mensual',
                'amount' => 2000.00, 
                'start_date' => now()->startOfMonth(),
                'end_date' => now()->endOfMonth(),
                'status' => 'pending',
                'is_custom' => false,
                'description' => 'Default goal for the user.',
            ]);
        }

        return $defaultGoal;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
