<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\StockManagement;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products = Product::factory()->count(1000)->create();
        $Warehouses = Warehouse::factory()->count(10)->create();
        StockMovement::factory()->count(10000)->create([
            'product_id' => fn() => $products->random()->id,
            'warehouse_id' => fn() => $Warehouses->random()->id
        ]);
    }
}
