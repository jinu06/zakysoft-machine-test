<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $fillable = [
        'stock_movement_id',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function stockMovement()
    {
        return $this->belongsTo(StockMovement::class);
    }
}
