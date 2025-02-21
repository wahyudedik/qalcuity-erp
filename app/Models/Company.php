<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Company extends Model
{
    use UsesTenantConnection;

    protected $table = 'companies';
    
    protected $fillable = [
        'name',
    ];
}
