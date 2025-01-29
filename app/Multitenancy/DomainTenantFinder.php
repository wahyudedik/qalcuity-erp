<?php
namespace App\Multitenancy;

use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder;

class DomainTenantFinder extends TenantFinder
{
    public function findForRequest(Request $request): ?Tenant
    {
        return Tenant::where('domain', $request->getHost())->first();
    }
}
