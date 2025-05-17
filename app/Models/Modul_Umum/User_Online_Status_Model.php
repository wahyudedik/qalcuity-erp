<?php

namespace App\Models\Modul_Umum;

use App\Models\Modul_Auth\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_Online_Status_Model extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_online_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'is_online',
        'last_active_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_online' => 'boolean',
        'last_active_at' => 'datetime',
    ];

    /**
     * Get the user associated with the online status.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Update the user's online status.
     */
    public function updateStatus(bool $isOnline): void
    {
        $this->update([
            'is_online' => $isOnline,
            'last_active_at' => now(),
        ]);
    }

    /**
     * Check if the user is recently active.
     */
    public function isRecentlyActive(int $minutes = 5): bool
    {
        if ($this->is_online) {
            return true;
        }

        return $this->last_active_at && $this->last_active_at->gt(now()->subMinutes($minutes));
    }
}
