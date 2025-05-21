<?php

namespace App\Models\Modul\Umum;

use App\Models\Modul\Branch\Branch;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modul\Umum\CameraAccessLog;
use App\Models\Modul\Umum\CameraRecording;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Camera extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cameras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ip_address',
        'port',
        'rtsp_url',
        'http_url',
        'username',
        'password',
        'location',
        'description',
        'is_active',
        'status',
        'branch_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'port' => 'integer',
    ];

    /**
     * Get the branch that the camera belongs to.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * Get the recordings for the camera.
     */
    public function recordings()
    {
        return $this->hasMany(CameraRecording::class, 'camera_id');
    }

    /**
     * Get the access logs for the camera.
     */
    public function accessLogs()
    {
        return $this->hasMany(CameraAccessLog::class, 'camera_id');
    }

    /**
     * Get the full streaming URL for the camera.
     *
     * @return string
     */
    public function getStreamingUrlAttribute()
    {
        if ($this->rtsp_url) {
            return $this->rtsp_url;
        }

        if ($this->http_url) {
            return $this->http_url;
        }

        return "http://{$this->ip_address}:{$this->port}/video";
    }

    /**
     * Check if camera is online.
     *
     * @return bool
     */
    public function isOnline()
    {
        return $this->status === 'online';
    }
}
