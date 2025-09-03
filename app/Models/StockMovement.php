<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "warehouse_id",
        "quantity",
        "type",
        "movement_date"
    ];

    protected function casts(): array
    {
        return [
            'movement_date' => 'datetime',
            'quantity' => 'integer',
        ];
    }
}
