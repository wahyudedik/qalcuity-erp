<?php

namespace App\Listeners\Modul\Branch;

use App\Events\Modul\Branch\BranchCreatedEvent;
use App\Events\Modul\Branch\BranchUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogBranchActivityListener
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event instanceof BranchCreatedEvent) {
            Log::info("Branch created: {$event->branch->name}");
        } elseif ($event instanceof BranchUpdatedEvent) {
            Log::info("Branch updated: {$event->branch->name}");
        }
    }
}
