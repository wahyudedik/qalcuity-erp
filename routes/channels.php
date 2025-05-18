<?php

use App\Models\Modul_Umum\Conversation_Model;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.Modul_Auth.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id; 
});

// Chat channels
Broadcast::channel('conversation.{id}', function ($user, $id) {
    return \App\Models\Modul_Umum\Participant_Model::where('conversation_id', $id)
        ->where('user_id', $user->id)
        ->exists();
});

Broadcast::channel('user-status', function () {
    return true;
});
