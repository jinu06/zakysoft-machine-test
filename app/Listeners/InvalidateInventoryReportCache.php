<?php

namespace App\Listeners;

use App\Events\StockMovementRecorded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class InvalidateInventoryReportCache
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StockMovementRecorded $event): void
    {
        Cache::tags(['invoice_report_'])->flush();
        Log::info("Cache flused on " . now(), [
            'stock_movement_data' => $event->stockMovement->id
        ]);
    }
}
