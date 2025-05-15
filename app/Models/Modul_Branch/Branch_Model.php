<?php

namespace App\Models\Modul_Branch;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Branch_Model extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'branches';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
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
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
