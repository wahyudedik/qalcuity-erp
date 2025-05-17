<?php

namespace App\Models\Modul_Umum;

use App\Models\Modul_Auth\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Conversation_Model extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'last_message_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /**
     * Get the participants for the conversation.
     */
    public function participants(): HasMany
    {
        return $this->hasMany(Participant_Model::class, 'conversation_id');
    }

    /**
     * Get the messages for the conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message_Model::class, 'conversation_id');
    }

    /**
     * Get the latest message for the conversation.
     */
    public function latestMessage()
    {
        return $this->hasOne(Message_Model::class, 'conversation_id')
                    ->latest('created_at');
    }

    /**
     * Check if conversation is a group chat.
     */
    public function isGroupChat(): bool
    {
        return $this->type === 'group';
    }

    /**
     * Get the name for direct conversations.
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->isGroupChat()) {
            return $this->name ?? 'Group Chat';
        }

        // For direct chats, get the other participant's name
        $otherParticipant = $this->participants()
                                ->whereNot('user_id', Auth::id())
                                ->first();
                                
        if ($otherParticipant && $otherParticipant->user) {
            return $otherParticipant->user->name;
        }

        return 'Unknown';
    }

    /**
     * Get all users in this conversation.
     */
    public function users()
    {
        return User::whereIn('id', $this->participants()->pluck('user_id'));
    }
}
