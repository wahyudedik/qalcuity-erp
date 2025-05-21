<?php

namespace App\Events\Modul\Branch;

use App\Models\Modul\Branch\Branch;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BranchCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $branch;

    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }
}