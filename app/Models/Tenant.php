<?php

namespace App\Models;

use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    protected $table = 'tenants';

    protected $fillable = [
        'user_id',
        'gambar',
        'name',
        'alamat',
        'no_hp',
        'domain',
        'database'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
