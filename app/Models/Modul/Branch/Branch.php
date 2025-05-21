<?php

namespace App\Models\Modul\Branch;

use App\Models\Modul\Auth\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasUuids, HasFactory, SoftDeletes;
    
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'code',
        'address',
        'city', 
        'province',
        'postal_code',
        'phone',
        'email',
        'manager_name',
        'is_active',
        'latitude',
        'longitude',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * Get users associated with this branch
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'branch_user');
    }
    
    /**
     * Scope a query to only include active branches.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
