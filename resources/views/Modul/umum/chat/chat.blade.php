@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <!-- Page Header -->
        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Chat</h2>
            <p class="text-gray-600 dark:text-gray-400">Communicate with other users</p>
        </div>

        <!-- Chat Container -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-[calc(100vh-280px)]">
            <!-- Sidebar: Conversations & Users -->
            <div class="md:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow">
                <!-- Tabs -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="chatTabs"
                        data-tabs-toggle="#chatTabContent" role="tablist">
                        <li class="w-1/2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="conversations-tab"
                                data-tabs-target="#conversations" type="button" role="tab"
                                aria-controls="conversations" aria-selected="true">Chats</button>
                        </li>
                        <li class="w-1/2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="users-tab" data-tabs-target="#users" type="button" role="tab" aria-controls="users"
                                aria-selected="false">Users</button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div id="chatTabContent" class="h-[calc(100%-48px)] overflow-y-auto">
                    <!-- Conversations Tab -->
                    <div class="hidden p-2 h-full" id="conversations" role="tabpanel" aria-labelledby="conversations-tab">
                        <!-- Search -->
                        <div class="relative mb-2">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="conversation-search"
                                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search conversations...">
                        </div>

                        <!-- Create Group Button -->
                        <button data-modal-target="createGroupModal" data-modal-toggle="createGroupModal"
                            class="w-full flex items-center justify-center p-2 mb-2 text-sm font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                </path>
                            </svg>
                            Create Group
                        </button>

                        <!-- Conversations List -->
                        <div class="space-y-2 conversation-list">
                            @forelse($conversations ?? [] as $conversation)
                                <a href="{{ route('chat.show', $conversation) }}"
                                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 @if (isset($currentConversation) && $currentConversation->id === $conversation->id) bg-gray-100 dark:bg-gray-700 @endif">
                                    <!-- Avatar: Show group icon or user avatar -->
                                    @if ($conversation->isGroupChat())
                                        <div
                                            class="relative w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                                </path>
                                            </svg>
                                        </div>
                                    @else
                                        @php
                                            $otherUser =
                                                $conversation->participants
                                                    ->where('user_id', '!=', auth()->id())
                                                    ->first()->user ?? null;
                                        @endphp
                                        @if ($otherUser)
                                            <img class="w-10 h-10 rounded-full" src="{{ $otherUser->avatar_url }}"
                                                alt="{{ $otherUser->name }}">
                                            <span class="relative flex h-3 w-3 -ml-2 mt-6">
                                                <span id="user-status-{{ $otherUser->id }}"
                                                    class="user-status-indicator absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
                                            </span>
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                                        @endif
                                    @endif

                                    <!-- Conversation details -->
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex justify-between items-center">
                                            <p
                                                class="text-sm font-medium text-gray-900 dark:text-white truncate conversation-name">
                                                {{ $conversation->display_name }}
                                            </p>
                                            @if ($conversation->last_message_at)
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $conversation->last_message_at->diffForHumans(null, true) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <p
                                                class="text-xs text-gray-500 dark:text-gray-400 truncate conversation-last-message">
                                                @if ($conversation->latestMessage)
                                                    @if ($conversation->latestMessage->user_id == auth()->id())
                                                        <span class="text-gray-400 dark:text-gray-500">You: </span>
                                                    @else
                                                        <span
                                                            class="text-gray-400 dark:text-gray-500">{{ $conversation->latestMessage->user->name ?? 'Unknown' }}:
                                                        </span>
                                                    @endif
                                                    {{ Str::limit($conversation->latestMessage->content, 30) }}
                                                @else
                                                    No messages yet
                                                @endif
                                            </p>

                                            <!-- Unread count badge -->
                                            @php
                                                $participant = $conversation->participants
                                                    ->where('user_id', auth()->id())
                                                    ->first();
                                                $unreadCount = $participant
                                                    ? $participant->getUnreadMessagesCount()
                                                    : 0;
                                            @endphp

                                            @if ($unreadCount > 0)
                                                <span id="unread-badge-{{ $conversation->id }}"
                                                    class="inline-flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-blue-500 rounded-full">
                                                    {{ $unreadCount }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                                    <p>No conversations yet</p>
                                    <p class="text-sm">Start a new conversation!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Users Tab -->
                    <div class="hidden p-2 h-full" id="users" role="tabpanel" aria-labelledby="users-tab">
                        <!-- Search -->
                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="users-search"
                                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search users...">
                        </div>

                        <!-- Users List (will be populated via AJAX) -->
                        <div class="space-y-2 users-list">
                            <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                                <div role="status" class="flex justify-center">
                                    <svg aria-hidden="true"
                                        class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676                                             39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p class="mt-2">Loading users...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="md:col-span-3 bg-white dark:bg-gray-800 rounded-lg shadow flex flex-col h-full">
                @if (isset($currentConversation))
                    <!-- Chat Header -->
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <div class="flex items-center">
                            @if ($currentConversation->isGroupChat())
                                <div
                                    class="relative w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                </div>
                            @else
                                @php
                                    $otherUser =
                                        $currentConversation->participants
                                            ->where('user_id', '!=', auth()->id())
                                            ->first()->user ?? null;
                                @endphp
                                @if ($otherUser)
                                    <img class="w-10 h-10 rounded-full" src="{{ $otherUser->avatar_url }}"
                                        alt="{{ $otherUser->name }}">
                                    <span class="relative flex h-3 w-3 -ml-2 mt-6">
                                        <span id="chat-user-status-{{ $otherUser->id }}"
                                            class="user-status-indicator absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
                                    </span>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                                @endif
                            @endif

                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $currentConversation->display_name }}
                                </h3>
                                @if (!$currentConversation->isGroupChat() && isset($otherUser))
                                    <p id="chat-user-status-text-{{ $otherUser->id }}"
                                        class="text-xs text-gray-500 dark:text-gray-400 user-status-text">
                                        Offline
                                    </p>
                                @else
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $currentConversation->participants->count() }} members
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Conversation Actions Dropdown -->
                        <div>
                            <button id="conversationActionsButton" data-dropdown-toggle="conversationActionsDropdown"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 4 15">
                                    <path
                                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="conversationActionsDropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="conversationActionsButton">
                                    @if ($currentConversation->isGroupChat())
                                        <li>
                                            <button data-modal-target="groupInfoModal" data-modal-toggle="groupInfoModal"
                                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Group Info
                                            </button>
                                        </li>
                                        <li>
                                            <button data-modal-target="addParticipantsModal"
                                                data-modal-toggle="addParticipantsModal"
                                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Add Participants
                                            </button>
                                        </li>
                                    @endif
                                    <li>
                                        <button id="toggleMuteBtn"
                                            class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            @php
                                                $participant = $currentConversation->participants
                                                    ->where('user_id', auth()->id())
                                                    ->first();
                                                $isMuted = $participant ? $participant->is_muted : false;
                                            @endphp
                                            {{ $isMuted ? 'Unmute' : 'Mute' }} Notifications
                                        </button>
                                    </li>
                                    <li>
                                        <button id="leaveConversationBtn"
                                            class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-red-400">
                                            {{ $currentConversation->isGroupChat() ? 'Leave Group' : 'Delete Chat' }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div id="messagesContainer" class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50 dark:bg-gray-900">
                        @foreach ($messages ?? [] as $message)
                            <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                @if ($message->is_system_message)
                                    <div
                                        class="mx-auto my-2 px-4 py-2 text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 rounded-full">
                                        {{ $message->content }}
                                    </div>
                                @else
                                    @if ($message->user_id !== auth()->id())
                                        <div class="flex items-start">
                                            <img class="w-8 h-8 rounded-full mr-2" src="{{ $message->user->avatar_url }}"
                                                alt="{{ $message->user->name }}">
                                            <div class="max-w-xs bg-white dark:bg-gray-700 rounded-lg p-3 shadow-sm">
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                                    {{ $message->user->name }}
                                                </div>
                                                @if ($message->type === 'text')
                                                    <p class="text-sm text-gray-900 dark:text-white">
                                                        {{ $message->content }}
                                                    </p>
                                                @elseif ($message->type === 'image')
                                                    <img src="{{ asset('storage/' . $message->file_path) }}"
                                                        class="max-w-full rounded" alt="Image">
                                                @elseif ($message->type === 'file')
                                                    <a href="{{ asset('storage/' . $message->file_path) }}"
                                                        class="flex items-center text-blue-600 dark:text-blue-400 hover:underline"
                                                        target="_blank">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ basename($message->file_path) }}
                                                    </a>
                                                @endif
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-right">
                                                    {{ $message->created_at->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="max-w-xs bg-blue-500 rounded-lg p-3 shadow-sm">
                                            @if ($message->type === 'text')
                                                <p class="text-sm text-white">
                                                    {{ $message->content }}
                                                </p>
                                            @elseif ($message->type === 'image')
                                                <img src="{{ asset('storage/' . $message->file_path) }}"
                                                    class="max-w-full rounded" alt="Image">
                                            @elseif ($message->type === 'file')
                                                <a href="{{ asset('storage/' . $message->file_path) }}"
                                                    class="flex items-center text-white hover:underline" target="_blank">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ basename($message->file_path) }}
                                                </a>
                                            @endif
                                            <div class="text-xs text-blue-100 mt-1 text-right">
                                                {{ $message->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Message Input -->
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                        <form id="messageForm" action="{{ route('chat.send', $currentConversation->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex items-center space-x-2">
                                <button type="button" id="attachmentBtn"
                                    class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <span class="sr-only">Upload file</span>
                                </button>
                                <input type="file" id="fileInput" name="file" class="hidden">
                                <input type="text" name="content" id="messageInput"
                                    class="block mx-4 p-2.5 w-full text                                    -sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Type a message...">
                                <button type="submit"
                                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                    <svg class="w-5 h-5 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 18 20">
                                        <path
                                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                                    </svg>
                                    <span class="sr-only">Send message</span>
                                </button>
                            </div>
                            <div id="filePreview" class="mt-2 hidden">
                                <div class="flex items-center bg-gray-100 dark:bg-gray-700 p-2 rounded">
                                    <span id="fileName"
                                        class="flex-1 truncate text-sm text-gray-700 dark:text-gray-300"></span>
                                    <button type="button" id="removeFileBtn"
                                        class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="flex-1 flex items-center justify-center p-4">
                        <div class="text-center">
                            <div
                                class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 mb-4">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">No conversation selected</h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">Select a conversation from the list or start a
                                new one</p>
                            <button data-modal-target="createGroupModal" data-modal-toggle="createGroupModal"
                                class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                    </path>
                                </svg>
                                Create Group
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create Group Modal -->
    <div id="createGroupModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create Group
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="createGroupModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form id="createGroupForm" action="{{ route('chat.create-group') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="group-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group Name</label>
                            <input type="text" id="group-name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Enter group name" required>
                        </div>
                        <div class="mb-4">
                            <label for="participants"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                Participants</label>
                            <div id="create-group-participants-list"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white h-48 overflow-y-auto">
                                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                                    <div role="status" class="flex justify-center">
                                        <svg aria-hidden="true"
                                            class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <p class="mt-2">Loading users...</p>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Create Group
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Group Info Modal -->
    @if (isset($currentConversation) && $currentConversation->isGroupChat())
        <div id="groupInfoModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Group Info
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="groupInfoModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="mb-4">
                            <label for="group-name-info"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group Name</label>
                            <input type="text" id="group-name-info" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ $currentConversation->name }}" readonly>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Participants
                                ({{ $currentConversation->participants->count() }})</label>
                            <div id="group-participants-list"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white h-48 overflow-y-auto">
                                @foreach ($currentConversation->participants as $participant)
                                    <div
                                        class="flex items-center justify-between py-2 px-1 border-b border-gray-200 dark:border-gray-600 last:border-0">
                                        <div class="flex items-center">
                                            <img class="w-8 h-8 rounded-full mr-2"
                                                src="{{ $participant->user->avatar_url }}"
                                                alt="{{ $participant->user->name }}">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $participant->user->name }}
                                                    @if ($participant->user_id === auth()->id())
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">(You)</span>
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $participant->user->email }}
                                                </p>
                                            </div>
                                        </div>
                                        @if ($participant->user_id !== auth()->id())
                                            <button type="button" data-user-id="{{ $participant->user_id }}"
                                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 remove-participant-btn">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" data-modal-hide="groupInfoModal"
                                class="flex-1 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Close
                            </button>
                            <button type="button" id="leaveGroupBtn"
                                class="flex-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                Leave Group
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Participants Modal -->
        <div id="addParticipantsModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Participants
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="addParticipantsModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form id="addParticipantsForm"
                            action="{{ route('chat.add-participants', $currentConversation->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="new-participants"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                    Users</label>
                                <div id="add-participants-list"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white h-48 overflow-y-auto">
                                    <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                                        <div role="status" class="flex justify-center">
                                            <svg aria-hidden="true"
                                                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <p class="mt-2">Loading users...</p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add Selected Users
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        if (window.Echo === undefined) {
            console.error('Echo tidak diinisialisasi, coba muat ulang halaman');
        }

        // DOM Elements
        const messagesContainer = document.getElementById('messagesContainer');
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const removeFileBtn = document.getElementById('removeFileBtn');
        const attachmentBtn = document.getElementById('attachmentBtn');
        const toggleMuteBtn = document.getElementById('toggleMuteBtn');
        const leaveConversationBtn = document.getElementById('leaveConversationBtn');
        const leaveGroupBtn = document.getElementById('leaveGroupBtn');
        const createGroupForm = document.getElementById('createGroupForm');
        const addParticipantsForm = document.getElementById('addParticipantsForm');
        const removeParticipantBtns = document.querySelectorAll('.remove-participant-btn');
        const conversationSearch = document.getElementById('conversation-search');
        const usersSearch = document.getElementById('users-search');

        // User ID from auth
        const userId = "{{ auth()->id() }}";

        // Current conversation ID
        @if (isset($currentConversation))
            const conversationId = "{{ $currentConversation->id }}";
        @else
            const conversationId = null;
        @endif

        // Import echoReadyPromise
        const waitForEcho = () => {
            return new Promise((resolve) => {
                // Check if Echo is already available
                if (window.Echo) {
                    return resolve(window.Echo);
                }

                // If not, check every 100ms for up to 5 seconds
                let attempts = 0;
                const maxAttempts = 50; // 5 seconds

                const interval = setInterval(() => {
                    attempts++;

                    if (window.Echo) {
                        clearInterval(interval);
                        resolve(window.Echo);
                    } else if (attempts >= maxAttempts) {
                        clearInterval(interval);
                        console.error('Echo initialization timeout');
                        resolve(null);
                    }
                }, 100);
            });
        };

        // Echo setup for real-time messaging
        waitForEcho().then(echo => {
            if (!echo) {
                console.error('Echo tidak diinisialisasi, coba muat ulang halaman');
                return;
            }

            @if (isset($currentConversation))
                echo.private('conversation.{{ $currentConversation->id }}')
                    .listen('MessageSent', (e) => {
                        appendMessage(e.message);
                        scrollToBottom();

                        // Mark as read if it's our own message or if we're actively viewing
                        if (e.message.user_id === userId || document.visibilityState === 'visible') {
                            markMessageAsRead(e.message.id);
                        }

                        // Update conversation list with latest message
                        updateConversationInList(e.message);
                    });
            @endif

            // Listen for user status changes
            echo.channel('user-status')
                .listen('UserStatusChanged', (e) => {
                    updateUserStatus(e.user.id, e.isOnline);
                });
        });

        // Functions
        function scrollToBottom() {
            if (messagesContainer) {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }

        function appendMessage(message) {
            if (!messagesContainer) return;

            const isCurrentUser = message.user_id === userId;
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${isCurrentUser ? 'justify-end' : 'justify-start'}`;

            if (message.is_system_message) {
                messageDiv.innerHTML = `
                <div class="mx-auto my-2 px-4 py-2 text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 rounded-full">
                    ${message.content}
                </div>
            `;
            } else if (isCurrentUser) {
                let messageContent = '';

                if (message.type === 'text') {
                    messageContent = `<p class="text-sm text-white">${message.content}</p>`;
                } else if (message.type === 'image') {
                    messageContent = `<img src="/storage/${message.file_path}" class="max-w-full rounded" alt="Image">`;
                } else if (message.type === 'file') {
                    const fileName = message.file_path.split('/').pop();
                    messageContent = `
                    <a href="/storage/${message.file_path}" class="flex items-center text-white hover:underline" target="_blank">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                        </svg>
                        ${fileName}
                    </a>
                `;
                }

                messageDiv.innerHTML = `
                <div class="max-w-xs bg-blue-500 rounded-lg p-3 shadow-sm">
                    ${messageContent}
                    <div class="text-xs text-blue-100 mt-1 text-right">
                        ${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                    </div>
                </div>
            `;
            } else {
                let messageContent = '';

                if (message.type === 'text') {
                    messageContent = `<p class="text-sm text-gray-900 dark:text-white">${message.content}</p>`;
                } else if (message.type === 'image') {
                    messageContent = `<img src="/storage/${message.file_path}" class="max-w-full rounded" alt="Image">`;
                } else if (message.type === 'file') {
                    const fileName = message.file_path.split('/').pop();
                    messageContent = `
                    <a href="/storage/${message.file_path}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline" target="_blank">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                        </svg>
                        ${fileName}
                    </a>
                `;
                }

                messageDiv.innerHTML = `
                <div class="flex items-start">
                    <img class="w-8 h-8 rounded-full mr-2" src="${message.user.avatar_url}" alt="${message.user.name}">
                    <div class="max-w-xs bg-white dark:bg-gray-700 rounded-lg p-3 shadow-sm">
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                            ${message.user.name}
                        </div>
                        ${messageContent}
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-right">
                            ${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                        </div>
                    </div>
                </div>
            `;
            }

            messagesContainer.appendChild(messageDiv);
        }

        function markMessageAsRead(messageId) {
            if (!conversationId) return;

            fetch(`/chat/${conversationId}/mark-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message_id: messageId
                })
            });
        }

        function updateConversationInList(message) {
            const conversationItem = document.querySelector(`.conversation-list a[href*="${message.conversation_id}"]`);
            if (!conversationItem) return;

            // Update last message text
            const lastMessageEl = conversationItem.querySelector('.conversation-last-message');
            if (lastMessageEl) {
                let prefix = '';
                if (message.user_id === userId) {
                    prefix = '<span class="text-gray-400 dark:text-gray-500">You: </span>';
                } else {
                    prefix = `<span class="text-gray-400 dark:text-gray-500">${message.user.name}: </span>`;
                }

                let content = message.content;
                if (message.type !== 'text') {
                    content = message.type === 'image' ? 'Sent an image' : 'Sent a file';
                }

                if (content.length > 30) {
                    content = content.substring(0, 30) + '...';
                }

                lastMessageEl.innerHTML = prefix + content;
            }

            // Update time
            const timeEl = conversationItem.querySelector('.text-xs.text-gray-500');
            if (timeEl) {
                timeEl.textContent = 'just now';
            }

            // Move conversation to top of list
            const conversationList = conversationItem.parentNode;
            conversationList.insertBefore(conversationItem, conversationList.firstChild);

            // Update unread badge if it's not from current user
            if (message.user_id !== userId) {
                let unreadBadge = conversationItem.querySelector(`#unread-badge-${message.conversation_id}`);

                // If we're not viewing this conversation, increment or create badge
                if (conversationId !== message.conversation_id) {
                    if (unreadBadge) {
                        const count = parseInt(unreadBadge.textContent) + 1;
                        unreadBadge.textContent = count;
                    } else {
                        const badge = document.createElement('span');
                        badge.id = `unread-badge-${message.conversation_id}`;
                        badge.className =
                            'inline-flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-blue-500 rounded-full';
                        badge.textContent = '1';

                        const lastMessageContainer = conversationItem.querySelector(
                            '.flex.justify-between.items-center:last-child');
                        if (lastMessageContainer) {
                            lastMessageContainer.appendChild(badge);
                        }
                    }
                }
            }
        }

        function updateUserStatus(userId, isOnline) {
            // Update status indicators
            const statusIndicators = document.querySelectorAll(`#user-status-${userId}, #chat-user-status-${userId}`);
            statusIndicators.forEach(indicator => {
                if (indicator) {
                    indicator.className =
                        `user-status-indicator absolute inline-flex h-full w-full rounded-full ${isOnline ? 'bg-green-500' : 'bg-gray-400'} opacity-75`;
                }
            });

            // Update status text if in chat
            const statusText = document.querySelector(`#chat-user-status-text-${userId}`);
            if (statusText) {
                statusText.textContent = isOnline ? 'Online' : 'Offline';
            }
        }

        function loadUsers() {
            fetch('/chat/users', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Check if data.users exists, otherwise use an empty array
                    const users = data.users || [];
                    populateUsersList(users);
                    populateCreateGroupParticipants(users);

                    @if (isset($currentConversation) && $currentConversation->isGroupChat())
                        populateAddParticipantsList(users);
                    @endif
                })
                .catch(error => console.error('Error loading users:', error));
        }

        function populateUsersList(data) {
            const usersList = document.querySelector('.users-list');
            if (!usersList) return;

            // Extract users array from data
            const users = data.users || [];

            if (users.length === 0) {
                usersList.innerHTML = `
                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                    <p>No users found</p>
                </div>
            `;
                return;
            }

            usersList.innerHTML = '';

            users.forEach(user => {
                if (user.id === userId) return; // Skip current user

                const userItem = document.createElement('div');
                userItem.className =
                    'flex items-center justify-between p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700';
                userItem.innerHTML = `
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full" src="${user.avatar_url}" alt="${user.name}">
                    <span class="relative flex h-3 w-3 -ml-2 mt-6">
                        <span id="users-list-status-${user.id}" class="user-status-indicator absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
                    </span>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">${user.name}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${user.email}</p>
                    </div>
                </div>
                <button type="button" data-user-id="${user.id}" class="start-chat-btn text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            `;

                usersList.appendChild(userItem);

                // Update status
                updateUserStatus(user.id, user.is_online);
            });

            // Add event listeners to chat buttons
            document.querySelectorAll('.start-chat-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    startDirectChat(userId);
                });
            });
        }

        function populateCreateGroupParticipants(users) {
            const participantsList = document.getElementById('create-group-participants-list');
            if (!participantsList) return;

            if (users.length === 0) {
                participantsList.innerHTML = `
                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                    <p>No users found</p>
                </div>
            `;
                return;
            }

            participantsList.innerHTML = '';

            users.forEach(user => {
                if (user.id === userId) return; // Skip current user

                const userItem = document.createElement('div');
                userItem.className =
                    'flex items-center justify-between py-2 px-1 border-b border-gray-200 dark:border-gray-600 last:border-0';
                userItem.innerHTML = `
                <div class="flex items-center">
                    <img class="w-8 h-8 rounded-full mr-2" src="${user.avatar_url}" alt="${user.name}">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">${user.name}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${user.email}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <input id="participant-${user.id}" type="checkbox" name="participants[]" value="${user.id}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
            `;

                participantsList.appendChild(userItem);
            });
        }

        @if (isset($currentConversation) && $currentConversation->isGroupChat())
            function populateAddParticipantsList(users) {
                const participantsList = document.getElementById('add-participants-list');
                if (!participantsList) return;

                // Get current participant IDs
                const currentParticipantIds = [
                    @foreach ($currentConversation->participants as $participant)
                        "{{ $participant->user_id }}",
                    @endforeach
                ];

                // Filter out users who are already participants
                const availableUsers = users.filter(user =>
                    !currentParticipantIds.includes(user.id) && user.id !== userId
                );

                if (availableUsers.length === 0) {
                    participantsList.innerHTML = `
                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                    <p>All users are already in this group</p>
                </div>
            `;
                    return;
                }

                participantsList.innerHTML = '';

                availableUsers.forEach(user => {
                    const userItem = document.createElement('div');
                    userItem.className =
                        'flex items-center justify-between py-2 px-1 border-b border-gray-200 dark:border-gray-600 last:border-0';
                    userItem.innerHTML = `
                <div class="flex items-center">
                    <img class="w-8 h-8 rounded-full mr-2" src="${user.avatar_url}" alt="${user.name}">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">${user.name}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${user.email}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <input id="new-participant-${user.id}" type="checkbox" name="participants[]" value="${user.id}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
            `;

                    participantsList.appendChild(userItem);
                });
            }
        @endif

        function startDirectChat(otherUserId) {
            fetch('/chat/conversation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: otherUserId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.conversation_id) {
                        window.location.href = `/chat/${data.conversation_id}`;
                    }
                })
                .catch(error => console.error('Error starting chat:', error));
        }

        function filterConversations(query) {
            const conversationItems = document.querySelectorAll('.conversation-list a');

            conversationItems.forEach(item => {
                const name = item.querySelector('.font-medium').textContent.toLowerCase();
                if (name.includes(query.toLowerCase())) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        function filterUsers(query) {
            const userItems = document.querySelectorAll('.users-list > div');

            userItems.forEach(item => {
                const name = item.querySelector('.font-medium').textContent.toLowerCase();
                const email = item.querySelector('.text-xs.text-gray-500').textContent.toLowerCase();

                if (name.includes(query.toLowerCase()) || email.includes(query.toLowerCase())) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll to bottom of messages
            scrollToBottom();

            // Wait for Echo to be initialized before loading users
            waitForEcho().then(() => {
                // Load users
                loadUsers();

                // Set online status
                fetch('/chat/status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        is_online: true
                    })
                });
            });

            // Set offline status when page is unloaded
            window.addEventListener('beforeunload', function() {
                navigator.sendBeacon('/chat/offline', new Blob([JSON.stringify({
                    _token: '{{ csrf_token() }}'
                })], {
                    type: 'application/json'
                }));
            });

            // Mark messages as read when conversation is viewed
            if (conversationId) {
                fetch(`/chat/${conversationId}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }
        });

        // Message form submission
        if (messageForm) {
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!messageInput.value.trim() && !fileInput.files.length) {
                    return;
                }

                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        messageInput.value = '';
                        fileInput.value = '';
                        filePreview.classList.add('hidden');
                    })
                    .catch(error => console.error('Error sending message:', error));
            });
        }

        // File attachment handling
        if (attachmentBtn) {
            attachmentBtn.addEventListener('click', function() {
                fileInput.click();
            });
        }

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files.length) {
                    fileName.textContent = this.files[0].name;
                    filePreview.classList.remove('hidden');
                } else {
                    filePreview.classList.add('hidden');
                }
            });
        }

        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                filePreview.classList.add('hidden');
            });
        }

        // Toggle mute notifications
        if (toggleMuteBtn) {
            toggleMuteBtn.addEventListener('click', function() {
                fetch(`/chat/${conversationId}/mute`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.textContent = data.is_muted ? 'Unmute Notifications' : 'Mute Notifications';
                    })
                    .catch(error => console.error('Error toggling mute:', error));
            });
        }

        // Leave conversation
        if (leaveConversationBtn) {
            leaveConversationBtn.addEventListener('click', function() {
                if (confirm('Are you sure you want to leave this conversation?')) {
                    fetch(`/chat/${conversationId}/leave`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.location.href = '/chat';
                        })
                        .catch(error => console.error('Error leaving conversation:', error));
                }
            });
        }

        // Leave group from group info modal
        if (leaveGroupBtn) {
            leaveGroupBtn.addEventListener('click', function() {
                if (confirm('Are you sure you want to leave this group?')) {
                    fetch(`/chat/${conversationId}/leave`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.location.href = '/chat';
                        })
                        .catch(error => console.error('Error leaving group:', error));
                }
            });
        }

        // Create group form submission
        if (createGroupForm) {
            createGroupForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const selectedParticipants = Array.from(formData.getAll('participants[]'));

                if (!formData.get('name').trim()) {
                    alert('Please enter a group name');
                    return;
                }

                if (selectedParticipants.length === 0) {
                    alert('Please select at least one participant');
                    return;
                }

                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        window.location.href = `/chat/${data.conversation_id}`;
                    })
                    .catch(error => console.error('Error creating group:', error));
            });
        }

        // Add participants form submission
        if (addParticipantsForm) {
            addParticipantsForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const selectedParticipants = Array.from(formData.getAll('participants[]'));

                if (selectedParticipants.length === 0) {
                    alert('Please select at least one participant');
                    return;
                }

                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Close modal and reload page to show updated participants
                        window.location.reload();
                    })
                    .catch(error => console.error('Error adding participants:', error));
            });
        }

        // Remove participant buttons
        removeParticipantBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');

                if (confirm('Are you sure you want to remove this participant?')) {
                    fetch(`/chat/${conversationId}/participants/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Reload page to show updated participants
                            window.location.reload();
                        })
                        .catch(error => console.error('Error removing participant:', error));
                }
            });
        });

        // Search conversations
        if (conversationSearch) {
            conversationSearch.addEventListener('input', function() {
                filterConversations(this.value);
            });
        }

        // Search users
        if (usersSearch) {
            usersSearch.addEventListener('input', function() {
                filterUsers(this.value);
            });
        }
    </script>
@endpush
