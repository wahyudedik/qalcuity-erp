<?php 

namespace App\Services\Modul\Auth;

use App\Models\Modul\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Create a new user
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User 
    {
        // Handle password hashing
        $data['password'] = Hash::make($data['password']);
        
        // Handle avatar upload if provided
        if (isset($data['avatar']) && $data['avatar']) {
            $data['avatar'] = $data['avatar']->store('avatars', 'public');
        }
        
        return User::create($data);
    }
    
    /**
     * Update an existing user
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        // Only update password if provided
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        // Handle avatar upload if provided
        if (isset($data['avatar']) && $data['avatar']) {
            // Delete old avatar if exists
            if ($user->avatar && !str_contains($user->avatar, 'https://')) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $data['avatar'] = $data['avatar']->store('avatars', 'public');
        }
        
        $user->update($data);
        
        return $user;
    }
    
    /**
     * Delete a user and their related resources
     *
     * @param User $user
     * @return bool
     */
    public function deleteUser(User $user): bool
    {
        // Delete avatar if exists and not external URL
        if ($user->avatar && !str_contains($user->avatar, 'https://')) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        // Remove any related records or perform additional cleanup
        // For example: $user->onlineStatus()->delete();
        
        return $user->delete();
    }
}
