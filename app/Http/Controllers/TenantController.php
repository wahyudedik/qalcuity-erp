<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Multitenancy\Models\Tenant;

class TenantController extends Controller
{
    public function create()
    {
        $tenant = Tenant::create([
            'name' => 'Tenant Name',
            'domain' => 'tenant.qalcuity-erp.test',
            'database' => 'tenant_db_name'
        ]);

        $tenant->makeCurrent();

        return response()->json([
            'message' => 'Tenant created successfully',
            'tenant' => $tenant
        ]);
    }
}
 