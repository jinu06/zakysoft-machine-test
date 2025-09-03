<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location'
    ];

    public function StockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class, 'product_id');
    }
}
