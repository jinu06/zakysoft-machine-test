<?php

namespace App\Events;

use App\Models\StockMovement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockMovementRecorded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stockMovement;

    /**
     * Create a new event instance.
     */
    public function __construct(StockMovement $stockeMovement)
    {
        $this->stockMovement = $stockeMovement;
    }
}
