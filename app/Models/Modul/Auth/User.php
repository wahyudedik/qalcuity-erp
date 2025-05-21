<?php

namespace App\Models\Modul\Auth;

use Illuminate\Notifications\Notifiable;
use App\Models\Modul\Branch\Branch;
use App\Models\Modul\Umum\UserOnlineStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'usertype',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get branches that the user belongs to
     */
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_user');
    }

    /**
     * Check if user is assigned to a specific branch
     */
    public function isAssignedToBranch(string $branchId): bool
    {
        return $this->branches()->where('branch_id', $branchId)->exists();
    }

    /**
     * Check if user is a developer.
     *
     * @return bool
     */
    public function isDeveloper(): bool
    {
        return $this->usertype === 'dev';
    }

    /**
     * Check if user is a regular user.
     *
     * @return bool
     */
    public function isRegularUser(): bool
    {
        return $this->usertype === 'user';
    }

    /**
     * Check if user belongs to a specific branch
     */
    public function belongsToBranch($branchId)
    {
        return $this->branches->contains('id', $branchId);
    }

    /**
     * Get avatar URL
     *
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        if (!$this->avatar) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random';
        }

        if (str_contains($this->avatar, 'http')) {
            return $this->avatar;
        }

        return asset('storage/' . $this->avatar);
    }

    public function onlineStatus()
    {
        return $this->hasOne(UserOnlineStatus::class, 'user_id');
    }

    /**
     * Get user's current active branch
     */
    public function getCurrentBranch()
    {
        $currentBranchId = session('current_branch_id');

        if ($currentBranchId) {
            $branch = $this->branches->find($currentBranchId);
            if ($branch) {
                return $branch;
            }
        }

        // If no current branch is set or the branch doesn't exist anymore,
        // return the first branch or null if user has no branches
        if ($this->branches->isNotEmpty()) {
            $firstBranch = $this->branches->first();
            session(['current_branch_id' => $firstBranch->id]);
            return $firstBranch;
        }

        return null;
    }

    /**
     * Switch the user's current active branch
     */
    public function switchBranch($branchId)
    {
        if ($this->belongsToBranch($branchId)) {
            session(['current_branch_id' => $branchId]);
            return true;
        }

        return false;
    }

    /**
     * Get the notifications for the user.
     */
    public function notifications()
    {
        return $this->morphMany(\App\Models\Modul\Umum\Notification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get the unread notifications for the user.
     */
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }
}
