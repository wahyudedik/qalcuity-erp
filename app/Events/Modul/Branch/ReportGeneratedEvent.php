<?php

namespace App\Events\Modul\Branch;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportGeneratedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $reportUrl;
    public $reportType;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($userId, $reportUrl, $reportType = 'pdf')
    {
        $this->userId = $userId;
        $this->reportUrl = $reportUrl;
        $this->reportType = $reportType;
        $this->message = 'Laporan ' . strtoupper($reportType) . ' telah siap';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.'.$this->userId),
        ];
    }
    
    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'url' => $this->reportUrl,
            'type' => $this->reportType
        ];
    }
}
