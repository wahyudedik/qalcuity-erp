<?php

namespace App\Models\Modul\Umum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CameraRecording extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'camera_id',
        'file_path',
        'start_time',
        'end_time',
        'is_archived',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_archived' => 'boolean',
    ];

    /**
     * Get the camera that owns the recording.
     */
    public function camera()
    {
        return $this->belongsTo(Camera::class, 'camera_id');
    }
}
