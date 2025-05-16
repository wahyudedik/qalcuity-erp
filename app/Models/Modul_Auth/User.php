<?php

namespace App\Models\Modul_Auth;

use Illuminate\Notifications\Notifiable;
use App\Models\Modul_Branch\Branch_Model;
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
        'email',
        'password',
        'usertype',
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

    public function branches()
    {
        return $this->belongsToMany(Branch_Model::class);
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
}
