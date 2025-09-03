<?php

namespace App\Jobs;

use App\Models\StockLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LogStockMovement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $movementDetails;
    /**
     * Create a new job instance.
     */
    public function __construct(array $movementDetails)
    {
        $this->movementDetails = $movementDetails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        StockLog::create([
            'stock_movement_id' => $this->movementDetails['id'] ?? null,
            'details' => $this->movementDetails, // JSON
        ]);
        Log::info('Stock movement processed.', ['stock_movement_id' => $this->movementDetails['id'] ?? 'N/A']);
    }
}
