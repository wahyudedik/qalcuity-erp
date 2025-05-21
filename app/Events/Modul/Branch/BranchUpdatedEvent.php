<?php

namespace App\Events\Modul\Branch;

use App\Models\Modul\Branch\Branch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BranchUpdatedEvent
{
    use Dispatchable, SerializesModels;

    public $branch;
    public $originalData;

    public function __construct(Branch $branch, array $originalData)
    {
        $this->branch = $branch;
        $this->originalData = $originalData;
    }
}
