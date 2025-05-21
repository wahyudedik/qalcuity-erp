<?php

namespace App\Models\Modul\Umum;

use App\Models\Modul\Auth\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 
        'conversation_id',
        'user_id',
        'content',
        'type',
        'file_path',
        'is_system_message',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_system_message' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the conversation that owns the message.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    /**
     * Get the user that owns the message.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the reads for the message.
     */
    public function reads(): HasMany
    {
        return $this->hasMany(MessageRead::class, 'message_id');
    }

    /**
     * Check if the message is read by a specific user.
     */
    public function isReadBy(string $userId): bool
    {
        return $this->reads()->where('user_id', $userId)->exists();
    }

    /**
     * Get the file URL if the message has a file.
     */
    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        return Storage::url($this->file_path);
    }

    /**
     * Soft delete a message.
     */
    public function softDelete(): void
    {
        $this->update(['deleted_at' => now()]);
    }

    /**
     * Check if a message is deleted.
     */
    public function isDeleted(): bool
    {
        return $this->deleted_at !== null;
    }
}
