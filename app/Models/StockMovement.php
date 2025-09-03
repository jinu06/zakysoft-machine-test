<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function wareHouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}
