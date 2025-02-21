<?php

namespace App\Models;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Tenant extends BaseTenant
{
    use UsesLandlordConnection;
    
    protected $table = 'tenants';

    protected $fillable = [
        'name',
        'domain',
        'database',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function (Tenant $tenant) {
            $sanitizedDbName = str_replace([' ', '-'], '_', $tenant->database);
            $sanitizedDbName = preg_replace('/[^A-Za-z0-9_]/', '', $sanitizedDbName);
            $query = "CREATE DATABASE IF NOT EXISTS `{$sanitizedDbName}`";
            DB::statement($query);
            $tenant->database = $sanitizedDbName;
        });

        static::created(function (Tenant $tenant) {
            Artisan::call('tenants:artisan "migrate --database=tenant"');
        });
    }

    public function tenants()
    {
        return $this->belongsToMany(User::class, 'tenant_user');
    }

    public function hasUser($userId)
    {
        return $this->tenants()->where('user_id', $userId)->exists();
    }

}
