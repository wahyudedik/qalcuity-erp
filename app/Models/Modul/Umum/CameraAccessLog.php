<?php

namespace App\Models\Modul\Umum;

use App\Models\Modul\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CameraAccessLog extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'camera_id',
        'user_id',
        'accessed_at',
        'action',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'accessed_at' => 'datetime',
    ];

    /**
     * Get the camera that was accessed.
     */
    public function camera()
    {
        return $this->belongsTo(Camera::class, 'camera_id');
    }

    /**
     * Get the user who accessed the camera.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
