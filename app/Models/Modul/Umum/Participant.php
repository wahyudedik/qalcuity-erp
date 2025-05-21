<?php

namespace App\Models\Modul\Umum;

use App\Models\Modul\Auth\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'participants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'conversation_id',
        'user_id',
        'last_read_at', 
        'is_muted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_read_at' => 'datetime',
        'is_muted' => 'boolean',
    ];

    /**
     * Get the conversation that owns the participant.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    /**
     * Get the user that owns the participant.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mark all messages in the conversation as read for this participant.
     */
    public function markAsRead(): void
    {
        $this->update(['last_read_at' => now()]);
        
        // Also mark individual messages as read
        $messages = $this->conversation->messages()
                          ->whereNotIn('id', function ($query) {
                              $query->select('message_id')
                                    ->from('message_reads')
                                    ->where('user_id', $this->user_id);
                          })
                          ->get();
        
        foreach ($messages as $message) {
            MessageRead::create([
                'message_id' => $message->id,
                'user_id' => $this->user_id,
                'read_at' => now(),
            ]);
        }
    }

    /**
     * Get the count of unread messages for this participant.
     */
    public function getUnreadMessagesCount(): int
    {
        $query = $this->conversation->messages();
        
        if ($this->last_read_at) {
            $query->where('created_at', '>', $this->last_read_at);
        }
        
        return $query->whereNotIn('id', function ($subQuery) {
            $subQuery->select('message_id')
                     ->from('message_reads')
                     ->where('user_id', $this->user_id);
        })->count();
    }

    /**
     * Toggle mute status.
     */
    public function toggleMute(): void
    {
        $this->update(['is_muted' => !$this->is_muted]);
    }
}
