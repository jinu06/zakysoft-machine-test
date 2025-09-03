<?php

namespace App\Http\Controllers;

use App\Events\StockMovementRecorded;
use App\Http\Requests\StoreStockMovementRequest;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function report(Request $request)
    {

        try {
            $cacheKey = "invoice_report_" . md5(json_encode($request->all())); //  unique cache key for each requests
            $data = Cache::remember($cacheKey, now()->addHour(), function () use ($request) {
                $query = StockMovement::select(
                    'product_id',
                    'warehouse_id',
                    DB::raw('SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as total_stock') // sum the quantity as total_stock
                )
                    ->groupBy('product_id', 'warehouse_id');

                if ($request->has('product_id')) {
                    $query->where('product_id', $request->product_id);
                }

                if ($request->has('warehouse_id')) {
                    $query->where('warehouse_id', $request->warehouse_id);
                }
                // Eager loading
                $reportData = $query->with(['product:id,name,sku', 'warehouse:id,name,location'])->get();

                return $reportData->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'product_sku' => $item->product->sku,
                        'warehouse_id' => $item->warehouse_id,
                        'warehouse_name' => $item->warehouse->name,
                        'warehouse_location' => $item->warehouse->location,
                        'total_stock' => (int) $item->total_stock,
                    ];
                });
            });

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            Log::error('report genertaion failed', ['error' => $th->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => "Server Error"
            ], 500);
        }
    }

    public function storeStock(StoreStockMovementRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $stockMovement = new StockMovement();
            $stockMovement->fill($data);
            $stockMovement->save();

            StockMovementRecorded::dispatch($stockMovement); // trigger event to invalidate cache

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'data created successfully',
                'data' => $stockMovement
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('stock creation failed', ['error' => $th->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => "Server Error"
            ], 500);
        }
    }
}
