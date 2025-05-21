<?php

namespace App\Services\Modul\Auth;

use App\Models\Modul\Auth\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Jobs\Modul\Auth\DeleteOldAvatarJob;
use App\Events\Modul\Auth\AccountDeletedEvent;
use App\Events\Modul\Auth\ProfileUpdatedEvent;
use App\Events\Modul\Auth\PasswordUpdatedEvent;

class ProfileService
{
    /**
     * Update user profile information
     *
     * @param User $user
     * @param array $data
     * @param UploadedFile|null $avatar
     * @return User
     */
    public function updateProfile(User $user, array $data, ?UploadedFile $avatar = null): User
    {
        // Handle avatar upload if provided
        if ($avatar) {
            $this->handleAvatarUpload($user, $avatar);
            $data['avatar'] = $avatar ? $this->storeAvatar($avatar) : $user->avatar;
        }
        
        $user->update($data);
        
        event(new ProfileUpdatedEvent($user));
        
        return $user;
    }
    
    /**
     * Update user password
     *
     * @param User $user
     * @param string $password
     * @return User
     */
    public function updatePassword(User $user, string $password): User
    {
        $user->update([
            'password' => Hash::make($password),
        ]);
        
        event(new PasswordUpdatedEvent($user));
        
        return $user;
    }
    
    /**
     * Delete user account
     *
     * @param User $user
     * @return void
     */
    public function deleteAccount(User $user): void
    {
        if ($user->avatar && !str_contains($user->avatar, 'http')) {
            DeleteOldAvatarJob::dispatch($user->avatar);
        }
        
        $userId = $user->id;
        $user->delete();
        
        event(new AccountDeletedEvent($userId));
    }
    
    /**
     * Handle avatar upload process
     *
     * @param User $user
     * @param UploadedFile $avatar
     * @return void
     */
    private function handleAvatarUpload(User $user, UploadedFile $avatar): void
    {
        // Delete old avatar if exists and not a URL
        if ($user->avatar && !str_contains($user->avatar, 'http')) {
            DeleteOldAvatarJob::dispatch($user->avatar);
        }
    }
    
    /**
     * Store avatar and return the path
     *
     * @param UploadedFile $avatar
     * @return string
     */
    private function storeAvatar(UploadedFile $avatar): string
    {
        return $avatar->store('avatars', 'public');
    }
}