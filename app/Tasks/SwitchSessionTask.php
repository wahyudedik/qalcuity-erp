<?php

namespace App\Tasks;

use Spatie\Multitenancy\Tasks\SwitchTenantTask;

class SwitchSessionTask implements SwitchTenantTask
{
    public function makeCurrent($tenant): void
    {
        if (!$tenant) return;

        $sessionKey = "tenant_{$tenant->id}_session";
        config([
            'session.cookie' => $sessionKey,
            'session.domain' => env('SESSION_DOMAIN', null)
        ]);
    }

    public function forgetCurrent(): void
    {
        config([
            'session.cookie' => null,
            'session.domain' => null
        ]);
    }
}
