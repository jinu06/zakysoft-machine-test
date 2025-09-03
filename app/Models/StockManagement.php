<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockManagement extends Model
{
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
