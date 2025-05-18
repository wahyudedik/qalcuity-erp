<?php

namespace App\Http\Controllers\Modul_Umum;

use Illuminate\Http\Request;
use App\Models\Modul_Auth\User;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\Modul_Umum\MessageSent;
use App\Models\Modul_Umum\Message_Model;
use App\Events\Modul_Umum\UserStatusChanged;
use App\Models\Modul_Umum\Participant_Model;
use App\Models\Modul_Umum\Conversation_Model;
use App\Http\Requests\Modul_Umum\Chat_Request;
use App\Models\Modul_Umum\Message_Read_Model;
use App\Models\Modul_Umum\User_Online_Status_Model;

class Chat_Controller extends Controller
{
    /**
     * Display the chat interface.
     */
    public function index()
    {
        // Update user status to online
        $this->updateUserStatus(true);

        // Get all conversations for the current user
        $conversations = Conversation_Model::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['latestMessage', 'participants.user'])->get();

        // Set currentConversation to null for the index view
        $currentConversation = null;

        return view('modul_umum.chat', compact('conversations', 'currentConversation'));
    }

    /**
     * Show a specific conversation.
     */
    public function show(Conversation_Model $conversation)
    {
        // Check if user is part of this conversation
        $isParticipant = $conversation->participants()->where('user_id', Auth::id())->exists();

        if (!$isParticipant) {
            return redirect()->route('chat.index')->with('error', 'You are not authorized to view this conversation.');
        }

        // Mark all messages as read
        $participant = $conversation->participants()->where('user_id', Auth::id())->first();
        $participant->markAsRead();

        // Get all messages for this conversation
        $messages = $conversation->messages()->with('user')->orderBy('created_at', 'asc')->get();

        // Get all users for potential new conversations (exclude users already in conversation)
        $users = User::whereNotIn('id', $conversation->participants()->pluck('user_id'))->get();

        // Set currentConversation for consistency with the view
        $currentConversation = $conversation;
        $conversations = Conversation_Model::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['latestMessage', 'participants.user'])->get();

        return view('modul_umum.chat', [
            'currentConversation' => $currentConversation,
            'conversations' => $conversations,
            'messages' => $messages,
            'users' => $users
        ]);
    }

    /**
     * Create a new direct message conversation.
     */
    public function createDirectMessage(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $otherUser = User::findOrFail($request->user_id);

        // Check if conversation already exists between these users
        $existingConversation = Conversation_Model::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id());
        })->whereHas('participants', function ($query) use ($otherUser) {
            $query->where('user_id', $otherUser->id);
        })->where('type', 'direct')->first();

        if ($existingConversation) {
            return redirect()->route('chat.show', $existingConversation);
        }

        // Create new conversation
        $conversation = Conversation_Model::create([
            'type' => 'direct',
            'last_message_at' => now(),
        ]);

        // Add participants
        $conversation->participants()->create(['user_id' => Auth::id()]);
        $conversation->participants()->create(['user_id' => $otherUser->id]);

        return redirect()->route('chat.show', $conversation);
    }

    /**
     * Create a new group conversation.
     */
    public function createGroupConversation(Chat_Request $request)
    {
        try {
            // Validasi data group
            $validatedData = $request->validated();

            // Pastikan ada minimal 2 participants (selain user saat ini)
            if (empty($validatedData['participants']) || count($validatedData['participants']) < 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Group chat membutuhkan minimal 2 peserta'
                ], 422);
            }

            // Buat conversation baru dengan type 'group'
            $conversation = Conversation_Model::create([
                'name' => $validatedData['name'],
                'type' => 'group',
                'last_message_at' => now(),
            ]);

            // Tambahkan user saat ini sebagai participant
            Participant_Model::create([
                'conversation_id' => $conversation->id,
                'user_id' => Auth::id(),
                'last_read_at' => now(),
            ]);

            // Tambahkan participants lainnya
            foreach ($validatedData['participants'] as $userId) {
                Participant_Model::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $userId,
                ]);
            }

            // Tambahkan system message
            $message = Message_Model::create([
                'conversation_id' => $conversation->id,
                'user_id' => Auth::id(),
                'content' => Auth::user()->name . ' created this group',
                'type' => 'text',
                'is_system_message' => true,
            ]);

            // Load conversation dengan participants
            $conversation->load(['participants.user', 'messages.user']);

            // Broadcast event
            broadcast(new MessageSent($message))->toOthers();

            return response()->json([
                'status' => 'success',
                'conversation' => $conversation
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating group conversation: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create group conversation: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send a message.
     */
    public function sendMessage(Chat_Request $request, Conversation_Model $conversation)
    {
        // Check if user is part of this conversation
        $isParticipant = $conversation->participants()->where('user_id', Auth::id())->exists();

        if (!$isParticipant) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Create new message
        $message = new Message_Model([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'type' => 'text',
        ]);

        // If there's a file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('chat_files', $fileName, 'public');

            $message->file_path = $filePath;

            // Determine file type
            $fileType = $file->getMimeType();
            if (strpos($fileType, 'image') !== false) {
                $message->type = 'image';
            } elseif (strpos($fileType, 'video') !== false) {
                $message->type = 'video';
            } elseif (strpos($fileType, 'audio') !== false) {
                $message->type = 'audio';
            } else {
                $message->type = 'file';
            }
        }

        $message->save();

        // Update conversation last message timestamp
        $conversation->update(['last_message_at' => now()]);

        // Broadcast message to other participants
        broadcast(new MessageSent($message))->toOthers();

        if ($request->wantsJson()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->back();
    }

    /**
     * Add users to a group conversation.
     */
    public function addParticipants(Request $request, Conversation_Model $conversation)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        // Check if current user is in the conversation
        $isParticipant = $conversation->participants()->where('user_id', Auth::id())->exists();

        if (!$isParticipant || !$conversation->isGroupChat()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Add new participants
        foreach ($request->user_ids as $userId) {
            // Check if user is already a participant
            $exists = $conversation->participants()->where('user_id', $userId)->exists();

            if (!$exists) {
                $conversation->participants()->create(['user_id' => $userId]);

                // Create system message
                $userName = User::find($userId)->name;
                $message = $conversation->messages()->create([
                    'user_id' => Auth::id(),
                    'content' => $userName . ' was added to the conversation',
                    'type' => 'text',
                    'is_system_message' => true,
                ]);

                broadcast(new MessageSent($message));
            }
        }

        return redirect()->back()->with('success', 'Users added successfully.');
    }

    /**
     * Leave a group conversation.
     */
    public function leaveConversation(Conversation_Model $conversation)
    {
        // Check if user is part of this conversation
        $participant = $conversation->participants()->where('user_id', Auth::id())->first();

        if (!$participant || !$conversation->isGroupChat()) {
            return redirect()->route('chat.index')->with('error', 'Unauthorized action.');
        }

        // Delete participant
        $participant->delete();

        // Create system message about user leaving
        $userName = Auth::user()->name;
        $message = $conversation->messages()->create([
            'user_id' => Auth::id(),
            'content' => $userName . ' left the conversation',
            'type' => 'text',
            'is_system_message' => true,
        ]);

        broadcast(new MessageSent($message));

        return redirect()->route('chat.index')->with('success', 'You left the conversation.');
    }

    /**
     * Toggle mute status for a conversation.
     */
    public function toggleMute(Conversation_Model $conversation)
    {
        $participant = $conversation->participants()->where('user_id', Auth::id())->first();

        if (!$participant) {
            return redirect()->route('chat.index');
        }

        $participant->toggleMute();

        $status = $participant->is_muted ? 'muted' : 'unmuted';

        return redirect()->back()->with('success', "Conversation {$status}.");
    }

    /**
     * Get unread message count.
     */
    public function getUnreadCount()
    {
        $unreadCount = 0;

        $participants = Participant_Model::where('user_id', Auth::id())->get();

        foreach ($participants as $participant) {
            $unreadCount += $participant->getUnreadMessagesCount();
        }

        return response()->json(['unread_count' => $unreadCount]);
    }

    /**
     * Update user's online status.
     */
    private function updateUserStatus(bool $isOnline)
    {
        $status = User_Online_Status_Model::firstOrCreate(
            ['user_id' => Auth::id()],
            ['is_online' => false, 'last_active_at' => now()]
        );

        if ($status->is_online != $isOnline) {
            $status->updateStatus($isOnline);
            broadcast(new UserStatusChanged(Auth::user(), $isOnline));
        }
    }

    /**
     * Set user as offline when leaving chat.
     */
    public function setOffline()
    {
        $this->updateUserStatus(false);

        return response()->json(['status' => 'success']);
    }

    /**
     * Get online users.
     */
    public function getOnlineUsers()
    {
        $onlineUsers = User_Online_Status_Model::where('is_online', true)
            ->orWhere(function ($query) {
                $query->where('last_active_at', '>', now()->subMinutes(5));
            })
            ->with('user')
            ->get()
            ->pluck('user');

        return response()->json(['online_users' => $onlineUsers]);
    }

    public function updateGroupConversation(Request $request, $conversationId)
    {
        $conversation = Conversation_Model::findOrFail($conversationId);

        // Check if user is authorized to update this group
        // This should be a creator or admin check

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $conversation->name = $validated['name'];
        $conversation->save();

        return response()->json([
            'success' => true,
            'conversation' => $conversation
        ]);
    }

    /**
     * Get users for chat.
     */
    public function getUsers()
    {
        $users = User::where('id', '!=', Auth::id())
            ->select('id', 'name', 'email', 'avatar', 'username')
            ->with('onlineStatus')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar_url' => $user->avatar_url ?? $user->getAvatarUrlAttribute(),
                    'username' => $user->username,
                    'is_online' => optional($user->onlineStatus)->is_online ?? false,
                    'last_seen' => optional($user->onlineStatus)->last_active_at
                ];
            })->values()->toArray();

        return response()->json(['users' => $users]);
    }

    /**
     * Update user's online status (endpoint for periodic pings)
     */
    public function updateStatus()
    {
        $this->updateUserStatus(true);

        return response()->json(['status' => 'success']);
    }

    /**
     * Get available users to add to a conversation
     */
    public function getAvailableParticipants($conversationId)
    {
        $conversation = Conversation_Model::findOrFail($conversationId);

        // Get all participants in this conversation
        $existingParticipantIds = $conversation->participants()->pluck('user_id')->toArray();

        // Get all users except current participants
        $availableUsers = User::whereNotIn('id', $existingParticipantIds)
            ->select('id', 'name', 'email', 'avatar', 'username')
            ->with(['onlineStatus'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar_url' => $user->avatar_url,
                    'username' => $user->username,
                    'is_online' => $user->onlineStatus ? $user->onlineStatus->is_online : false,
                    'last_seen' => $user->onlineStatus ? $user->onlineStatus->last_seen : null,
                ];
            });

        return response()->json([
            'users' => $availableUsers
        ]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(Request $request, Conversation_Model $conversation)
    {
        // Check if user is part of this conversation
        $participant = $conversation->participants()->where('user_id', Auth::id())->first();

        if (!$participant) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messageId = $request->input('message_id');

        if ($messageId) {
            // Mark specific message as read
            $message = Message_Model::findOrFail($messageId);
            if ($message->conversation_id === $conversation->id) {
                Message_Read_Model::firstOrCreate([
                    'message_id' => $message->id,
                    'user_id' => Auth::id(),
                ], [
                    'read_at' => now()
                ]);
            }
        } else {
            // Mark all messages as read
            $participant->markAsRead();
        }

        return response()->json(['success' => true]);
    }
}
