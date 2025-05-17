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
                            @forelse($conversations as $conversation)
                                <a href="{{ route('chat.show', $conversation) }}"
                                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 @if (request()->route('conversation') && request()->route('conversation')->id === $conversation->id) bg-gray-100 dark:bg-gray-700 @endif">
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
                                                    class="user-status-indicator animate-pulse absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
                                            </span>
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                                        @endif
                                    @endif

                                    <!-- Conversation details -->
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex justify-between items-center">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                {{ $conversation->display_name }}
                                            </p>
                                            @if ($conversation->last_message_at)
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $conversation->last_message_at->diffForHumans(null, true) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                                @if ($conversation->latestMessage)
                                                    @if ($conversation->latestMessage->user_id == auth()->id())
                                                        <span class="text-gray-400 dark:text-gray-500">You: </span>
                                                    @else
                                                        <span
                                                            class="text-gray-400 dark:text-gray-500">{{ $conversation->latestMessage->user->name }}:
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
                                                <span
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
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
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

            <!-- Main Chat Area -->
            <div class="md:col-span-3 bg-white dark:bg-gray-800 rounded-lg shadow flex flex-col">
                @if (isset($currentConversation))
                    <!-- Chat Header -->
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <div class="flex items-center">
                            @if ($currentConversation->type === 'group')
                                <div
                                    class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                        {{ $currentConversation->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $currentConversation->participants->count() }} participants</p>
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
                                    <div class="ml-3">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                                            {{ $otherUser->name }}
                                            <span id="chat-user-status-{{ $otherUser->id }}"
                                                class="ml-2 inline-flex h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <span id="chat-user-status-text-{{ $otherUser->id }}">Offline</span>
                                        </p>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Conversation Actions Dropdown -->
                        <button id="conversationOptionsButton" data-dropdown-toggle="conversationOptions"
                            class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 focus:outline-none">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                </path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="conversationOptions"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="conversationOptionsButton">
                                @if ($currentConversation->type === 'group')
                                    <li>
                                        <a href="#" data-modal-target="viewParticipantsModal"
                                            data-modal-toggle="viewParticipantsModal"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            View participants
                                        </a>
                                    </li>
                                    @if ($currentConversation->isCreator(auth()->id()))
                                        <li>
                                            <a href="#" data-modal-target="addParticipantModal"
                                                data-modal-toggle="addParticipantModal"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Add participants
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" data-modal-target="editGroupModal"
                                                data-modal-toggle="editGroupModal"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Edit group
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Clear chat
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-red-400">
                                        Leave chat
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div id="messages-container" class="flex-grow p-4 overflow-y-auto">
                        @foreach ($messages as $message)
                            <div
                                class="chat-message mb-4 @if ($message->user_id === auth()->id()) chat-message-sender @else chat-message-receiver @endif">
                                <div class="flex items-start @if ($message->user_id === auth()->id()) justify-end @endif">
                                    <!-- Avatar (for receiver only) -->
                                    @if ($message->user_id !== auth()->id())
                                        <div class="flex-shrink-0 mr-3">
                                            <img class="h-8 w-8 rounded-full" src="{{ $message->user->avatar_url }}"
                                                alt="{{ $message->user->name }}">
                                        </div>
                                    @endif

                                    <!-- Message Content -->
                                    <div
                                        class="@if ($message->user_id === auth()->id()) bg-blue-500 text-white @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white @endif rounded-lg py-2 px-4 max-w-[75%]">
                                        @if ($currentConversation->type === 'group' && $message->user_id !== auth()->id())
                                            <div
                                                class="text-xs @if ($message->user_id === auth()->id()) text-blue-200 @else text-gray-500 dark:text-gray-400 @endif mb-1">
                                                {{ $message->user->name }}
                                            </div>
                                        @endif

                                        @if ($message->type === 'text')
                                            <p class="break-words">{{ $message->content }}</p>
                                        @elseif($message->type === 'image')
                                            <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $message->file_path) }}" alt="Image"
                                                    class="max-h-60 rounded">
                                            </a>
                                        @elseif($message->type === 'file')
                                            <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank"
                                                class="flex items-center">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ basename($message->file_path) }}
                                            </a>
                                        @endif

                                        <div
                                            class="text-xs @if ($message->user_id === auth()->id()) text-blue-200 @else text-gray-500 dark:text-gray-400 @endif mt-1 text-right">
                                            {{ $message->created_at->format('H:i') }}
                                            @if ($message->user_id === auth()->id())
                                                @if ($message->isReadByAll())
                                                    <svg class="w-3 h-3 inline-block ml-1" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg class="w-3 h-3 inline-block ml-1" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L9 12.586l7.293-7.293a1 1 0 011.414 1.414l-8 8z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Avatar (for sender only) -->
                                    @if ($message->user_id === auth()->id())
                                        <div class="flex-shrink-0 ml-3">
                                            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar_url }}"
                                                alt="{{ auth()->user()->name }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div id="typing-indicator" class="hidden chat-message mb-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                                </div>
                                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg py-2 px-4">
                                    <div class="flex space-x-1">
                                        <div
                                            class="typing-dot animate-bounce bg-gray-500 dark:bg-gray-400 h-2 w-2 rounded-full">
                                        </div>
                                        <div
                                            class="typing-dot animate-bounce bg-gray-500 dark:bg-gray-400 h-2 w-2 rounded-full animation-delay-200">
                                        </div>
                                        <div
                                            class="typing-dot animate-bounce bg-gray-500 dark:bg-gray-400 h-2 w-2 rounded-full animation-delay-400">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Input -->
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                        <form id="messageForm" class="flex items-end space-x-2">
                            <button type="button" id="attachButton"
                                class="p-2 text-gray-500 rounded-full hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                    </path>
                                </svg>
                            </button>

                            <div class="flex-grow">
                                <input type="text" id="message-input"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Type your message...">
                                <input type="file" id="file-input" class="hidden"
                                    accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt">
                            </div>

                            <button type="submit"
                                class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <!-- No Conversation Selected -->
                    <div
                        class="flex-grow flex flex-col items-center justify-center p-8 text-center text-gray-500 dark:text-gray-400">
                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <h3 class="text-xl font-medium mb-2">No conversation selected</h3>
                        <p class="max-w-md">Select a conversation from the sidebar or start a new one by clicking on a user
                            from the Users tab.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create Group Modal -->
    <div id="createGroupModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="createGroupModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Create a new group</h3>
                    <form id="createGroupForm" class="space-y-6" action="{{ route('chat.create-group') }}"
                        method="POST">
                        @csrf
                        <div>
                            <label for="group-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group name</label>
                            <input type="text" name="name" id="group-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Enter group name" required>
                        </div>
                        <div>
                            <label for="group-participants"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                participants</label>
                            <select id="group-participants" name="participants[]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                multiple>
                                <!-- Will be populated via JavaScript -->
                            </select>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You'll be added automatically</p>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                            Group</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Participants Modal -->
    <div id="viewParticipantsModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="viewParticipantsModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Group participants</h3>
                    <div id="participantsList" class="space-y-3 max-h-60 overflow-y-auto">
                        <!-- Will be populated via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Participant Modal -->
    <div id="addParticipantModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="addParticipantModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add participants</h3>
                    <form id="addParticipantForm" class="space-y-6"
                        action="{{ route('chat.add-participants', $currentConversation->id ?? 0) }}" method="POST">
                        @csrf
                        <div>
                            <label for="new-participants"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select users to
                                add</label>
                            <select id="new-participants" name="participants[]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                multiple>
                                <!-- Will be populated via JavaScript -->
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                            Participants</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Group Modal -->
    <div id="editGroupModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="editGroupModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit group</h3>
                    <form id="editGroupForm" class="space-y-6"
                        action="{{ route('chat.update-group', $currentConversation->id ?? 0) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="edit-group-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group name</label>
                            <input type="text" name="name" id="edit-group-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ $currentConversation->name ?? '' }}" required>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
                            Group</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const messagesContainer = document.getElementById('messages-container');
            const messageForm = document.getElementById('messageForm');
            const messageInput = document.getElementById('message-input');
            const fileInput = document.getElementById('file-input');
            const attachButton = document.getElementById('attachButton');
            const typingIndicator = document.getElementById('typing-indicator');
            const userSearchInput = document.getElementById('users-search');
            const conversationSearchInput = document.getElementById('conversation-search');

            // Conversation ID (if any)
            const conversationId = @json($currentConversation->id ?? null);
            const authUserId = @json(auth()->id());

            // Scroll to bottom of messages container
            function scrollToBottom() {
                if (messagesContainer) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            }

            // Initial scroll to bottom
            scrollToBottom();

            // Mark messages as read
            function markMessagesAsRead() {
                if (conversationId) {
                    fetch(`/chat/${conversationId}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                }
            }

            // Mark current messages as read when conversation is opened
            markMessagesAsRead();

            // Setup Echo listeners for real-time updates
            if (conversationId) {
                Echo.private(`conversation.${conversationId}`)
                    .listen('MessageSent', (e) => {
                        // Add the new message to the chat
                        appendMessage(e.message);

                        // If the message isn't from the current user, mark it as read
                        if (e.message.user_id !== authUserId) {
                            markMessagesAsRead();
                        }
                    })
                    .listenForWhisper('typing', (e) => {
                        if (e.user.id !== authUserId) {
                            // Show typing indicator
                            showTypingIndicator(e.user);

                            // Hide typing indicator after 3 seconds
                            setTimeout(() => {
                                hideTypingIndicator();
                            }, 3000);
                        }
                    });
            }

            // Setup Echo listener for user status updates
            Echo.channel('users.status')
                .listen('UserStatusChanged', (e) => {
                    updateUserStatus(e.userId, e.isOnline);
                });

            // Send message
            if (messageForm) {
                messageForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const message = messageInput.value.trim();

                    if (message === '' && !fileInput.files.length) {
                        return;
                    }

                    // Handle file upload if any
                    if (fileInput.files.length) {
                        const formData = new FormData();
                        formData.append('file', fileInput.files[0]);
                        formData.append('_token', '{{ csrf_token() }}');

                        fetch(`/chat/${conversationId}/upload`, {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Clear file input
                                fileInput.value = '';
                            })
                            .catch(error => {
                                console.error('Error uploading file:', error);
                            });
                    }

                    // Send text message if any
                    if (message !== '') {
                        fetch(`/chat/${conversationId}/send`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    content: message,
                                    type: 'text'
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Clear input
                                messageInput.value = '';
                                messageInput.focus();
                            })
                            .catch(error => {
                                console.error('Error sending message:', error);
                            });
                    }
                });
            }

            // Attach file
            if (attachButton) {
                attachButton.addEventListener('click', function() {
                    fileInput.click();
                });

                fileInput.addEventListener('change', function() {
                    if (fileInput.files.length) {
                        const fileName = fileInput.files[0].name;
                        messageInput.value = `Attaching: ${fileName}`;
                        messageInput.disabled = true;
                    } else {
                        messageInput.value = '';
                        messageInput.disabled = false;
                    }
                });
            }

            // User typing indicator
            let typingTimeout;
            if (messageInput) {
                messageInput.addEventListener('input', function() {
                    clearTimeout(typingTimeout);

                    // Emit typing event
                    if (conversationId) {
                        Echo.private(`conversation.${conversationId}`)
                            .whisper('typing', {
                                user: {
                                    id: authUserId,
                                    name: '{{ auth()->user()->name }}'
                                }
                            });
                    }

                    // Clear typing status after 2 seconds of inactivity
                    typingTimeout = setTimeout(() => {
                        // Could emit a "stopped typing" event if needed
                    }, 2000);
                });
            }

            // Show typing indicator
            function showTypingIndicator(user) {
                if (typingIndicator) {
                    // Update the typing indicator avatar if needed
                    typingIndicator.classList.remove('hidden');
                }
            }

            // Hide typing indicator
            function hideTypingIndicator() {
                if (typingIndicator) {
                    typingIndicator.classList.add('hidden');
                }
            }

            // Append new message to chat
            function appendMessage(message) {
                const isCurrentUser = message.user_id === authUserId;

                // Create message element
                const messageDiv = document.createElement('div');
                messageDiv.className =
                    `chat-message mb-4 ${isCurrentUser ? 'chat-message-sender' : 'chat-message-receiver'}`;

                let messageContent = '';

                // Message container
                messageContent += `<div class="flex items-start ${isCurrentUser ? 'justify-end' : ''}">`;

                // Avatar for receiver
                if (!isCurrentUser) {
                    messageContent += `
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-8 w-8 rounded-full" src="${message.user.avatar_url}" alt="${message.user.name}">
                    </div>
                `;
                }

                // Message bubble
                messageContent += `
                <div class="${isCurrentUser ? 'bg-blue-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white'} rounded-lg py-2 px-4 max-w-[75%]">
            `;

                // Group chat sender name
                if (!isCurrentUser &&
                    {{ isset($currentConversation) ? ($currentConversation->type === 'group' ? 'true' : 'false') : 'false' }}
                ) {
                    messageContent += `
                    <div class="text-xs ${isCurrentUser ? 'text-blue-200' : 'text-gray-500 dark:text-gray-400'} mb-1">
                        ${message.user.name}
                    </div>
                `;
                }

                // Message content based on type
                if (message.type === 'text') {
                    messageContent += `<p class="break-words">${message.content}</p>`;
                } else if (message.type === 'image') {
                    messageContent += `
                    <a href="/storage/${message.file_path}" target="_blank">
                        <img src="/storage/${message.file_path}" alt="Image" class="max-h-60 rounded">
                    </a>
                `;
                } else if (message.type === 'file') {
                    messageContent += `
                    <a href="/storage/${message.file_path}" target="_blank" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                        </svg>
                        ${message.file_path.split('/').pop()}
                    </a>
                `;
                }

                // Timestamp and read status
                messageContent += `
                <div class="text-xs ${isCurrentUser ? 'text-blue-200' : 'text-gray-500 dark:text-gray-400'} mt-1 text-right">
                    ${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                    ${isCurrentUser ? '<svg class="w-3 h-3 inline-block ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L9 12.586l7.293-7.293a1 1 0 011.414 1.414l-8 8z"></path></svg>' : ''}
                </div>
                </div>
            `;

                // Avatar for sender
                if (isCurrentUser) {
                    messageContent += `
                    <div class="flex-shrink-0 ml-3">
                        <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                    </div>
                `;
                }

                messageContent += '</div>';

                // Set the HTML content
                messageDiv.innerHTML = messageContent;

                // Append to container before the typing indicator
                messagesContainer.insertBefore(messageDiv, typingIndicator);

                // Scroll to bottom
                scrollToBottom();
            }

            // Update user online status
            function updateUserStatus(userId, isOnline) {
                // Update status indicator in sidebar
                const userStatusIndicator = document.getElementById(`user-status-${userId}`);
                if (userStatusIndicator) {
                    userStatusIndicator.className =
                        `user-status-indicator absolute inline-flex h-full w-full rounded-full ${isOnline ? 'bg-green-500' : 'bg-gray-400'} opacity-75`;
                }

                // Update status in chat header if applicable
                const chatUserStatusIndicator = document.getElementById(`chat-user-status-${userId}`);
                if (chatUserStatusIndicator) {
                    chatUserStatusIndicator.className =
                        `ml-2 inline-flex h-2.5 w-2.5 rounded-full ${isOnline ? 'bg-green-500' : 'bg-gray-400'}`;

                    const chatUserStatusText = document.getElementById(`chat-user-status-text-${userId}`);
                    if (chatUserStatusText) {
                        chatUserStatusText.textContent = isOnline ? 'Online' : 'Offline';
                    }
                }
            }

            // Load users for group creation and search
            function loadUsers() {
                fetch('/chat/users')
                    .then(response => response.json())
                    .then(data => {
                        // Clear loading state
                        document.querySelector('.users-list').innerHTML = '';

                        if (data.users.length === 0) {
                            document.querySelector('.users-list').innerHTML = `
                            <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                                <p>No users found</p>
                            </div>
                        `;
                            return;
                        }

                        // Populate users list for chat creation
                        const groupParticipantsSelect = document.getElementById('group-participants');
                        const newParticipantsSelect = document.getElementById('new-participants');

                        if (groupParticipantsSelect) {
                            groupParticipantsSelect.innerHTML = '';
                        }

                        if (newParticipantsSelect) {
                            newParticipantsSelect.innerHTML = '';
                        }

                        // Add users to the users list and select elements
                        data.users.forEach(user => {
                            if (user.id !== authUserId) {
                                // Add to users list for starting new chats
                                const userItem = document.createElement('div');
                                userItem.className =
                                    'flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer';
                                userItem.innerHTML = `
                                <img class="w-10 h-10 rounded-full" src="${user.avatar_url}" alt="${user.name}">
                                <span class="relative flex h-3 w-3 -ml-2 mt-6">
                                    <span id="user-status-${user.id}" class="user-status-indicator absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
                                </span>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">${user.name}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">${user.email}</p>
                                </div>
                            `;

                                // Add click event to start a new conversation
                                userItem.addEventListener('click', function() {
                                    createOrGetDirectConversation(user.id);
                                });

                                document.querySelector('.users-list').appendChild(userItem);

                                // Add to select elements for group creation
                                if (groupParticipantsSelect) {
                                    const option = document.createElement('option');
                                    option.value = user.id;
                                    option.textContent = user.name;
                                    groupParticipantsSelect.appendChild(option);
                                }

                                // Add to new participants select if the user is not already in the conversation
                                if (newParticipantsSelect && conversationId) {
                                    const isParticipant = @json($currentConversation->participants ?? collect()) - > some(p => p
                                        .user_id === user.id);

                                    if (!isParticipant) {
                                        const option = document.createElement('option');
                                        option.value = user.id;
                                        option.textContent = user.name;
                                        newParticipantsSelect.appendChild(option);
                                    }
                                }
                            }
                        });

                        // Initialize Flowbite's select plugin for multiple selects
                        if (groupParticipantsSelect) {
                            new Choices(groupParticipantsSelect, {
                                removeItemButton: true,
                                placeholder: true,
                                placeholderValue: 'Select users',
                            });
                        }

                        if (newParticipantsSelect) {
                            new Choices(newParticipantsSelect, {
                                removeItemButton: true,
                                placeholder: true,
                                placeholderValue: 'Select users to add',
                            });
                        }

                        // Update user status for each user
                        data.users.forEach(user => {
                            updateUserStatus(user.id, user.is_online);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading users:', error);
                    });
            }

            // Load participants for a group conversation
            function loadParticipants() {
                if (conversationId &&
                    {{ isset($currentConversation) ? ($currentConversation->type === 'group' ? 'true' : 'false') : 'false' }}
                    ) {
                    fetch(`/chat/${conversationId}/participants`)
                        .then(response => response.json())
                        .then(data => {
                            const participantsList = document.getElementById('participantsList');
                            if (participantsList) {
                                participantsList.innerHTML = '';

                                data.participants.forEach(participant => {
                                    const participantItem = document.createElement('div');
                                    participantItem.className = 'flex items-center justify-between';

                                    // Basic participant info
                                    participantItem.innerHTML = `
                                    <div class="flex items-center">
                                        <img class="w-10 h-10 rounded-full" src="${participant.user.avatar_url}" alt="${participant.user.name}">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">${participant.user.name}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">${participant.is_creator ? 'Creator' : 'Member'}</p>
                                        </div>
                                    </div>
                                `;

                                    // Add remove button for group creators (except for themselves)
                                    if ({{ isset($currentConversation) ? ($currentConversation->isCreator(auth()->id()) ? 'true' : 'false') : 'false' }} &&
                                        participant.user_id !== authUserId) {
                                        const removeButton = document.createElement('button');
                                        removeButton.className =
                                            'p-1 text-red-600 rounded-full hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700 focus:outline-none';
                                        removeButton.innerHTML = `
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    `;

                                        // Add click event to remove participant
                                        removeButton.addEventListener('click', function() {
                                            removeParticipant(participant.id);
                                        });

                                        participantItem.appendChild(removeButton);
                                    }

                                    participantsList.appendChild(participantItem);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error loading participants:', error);
                        });
                }
            }

            // Create or get direct conversation with a user
            function createOrGetDirectConversation(userId) {
                fetch('/chat/conversation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect to the conversation
                            window.location.href = `/chat/${data.conversation.id}`;
                        }
                    })
                    .catch(error => {
                        console.error('Error creating conversation:', error);
                    });
            }

            // Remove participant from group
            function removeParticipant(participantId) {
                if (confirm('Are you sure you want to remove this participant?')) {
                    fetch(`/chat/${conversationId}/participants/${participantId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Reload participants list
                                loadParticipants();
                            }
                        })
                        .catch(error => {
                            console.error('Error removing participant:', error);
                        });
                }
            }

            // Search users
            if (userSearchInput) {
                userSearchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const userItems = document.querySelectorAll('.users-list > div');

                    userItems.forEach(item => {
                        const name = item.querySelector('p.text-sm').textContent.toLowerCase();
                        const email = item.querySelector('p.text-xs').textContent.toLowerCase();

                        if (name.includes(searchTerm) || email.includes(searchTerm)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }

            // Search conversations
            if (conversationSearchInput) {
                conversationSearchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const conversationItems = document.querySelectorAll('.conversation-list > a');

                    conversationItems.forEach(item => {
                        const name = item.querySelector('p.text-sm').textContent.toLowerCase();
                        const lastMessage = item.querySelector('p.text-xs').textContent
                            .toLowerCase();

                        if (name.includes(searchTerm) || lastMessage.includes(searchTerm)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }

            // Initialize tabs
            const tabs = document.querySelectorAll('[data-tabs-toggle] button');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const target = document.querySelector(this.dataset.tabsTarget);

                    // Hide all tab contents
                    document.querySelectorAll('[data-tabs-toggle] + div > div').forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Deactivate all tabs
                    tabs.forEach(t => {
                        t.classList.remove('border-blue-600', 'text-blue-600');
                        t.classList.add('border-transparent');
                        t.setAttribute('aria-selected', 'false');
                    });

                    // Activate current tab
                    this.classList.remove('border-transparent');
                    this.classList.add('border-blue-600', 'text-blue-600');
                    this.setAttribute('aria-selected', 'true');

                    // Show current tab content
                    target.classList.remove('hidden');

                    // Load users when switching to Users tab
                    if (this.id === 'users-tab') {
                        loadUsers();
                    }
                });
            });

            // Initialize view participants modal
            document.querySelectorAll('[data-modal-target="viewParticipantsModal"]').forEach(el => {
                el.addEventListener('click', function() {
                    loadParticipants();
                });
            });

            // Initialize main tab
            document.getElementById('conversations-tab').click();

            // Check for new messages periodically (fallback if WebSockets are not working)
            if (conversationId) {
                setInterval(() => {
                    fetch(`/chat/${conversationId}/messages?last_id=${getLastMessageId()}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.messages && data.messages.length > 0) {
                                data.messages.forEach(message => {
                                    // Only append if not already in the DOM
                                    if (!document.querySelector(
                                            `[data-message-id="${message.id}"]`)) {
                                        appendMessage(message);
                                    }
                                });

                                // Mark messages as read if not from current user
                                if (data.messages.some(m => m.user_id !== authUserId)) {
                                    markMessagesAsRead();
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching new messages:', error);
                        });
                }, 10000); // Every 10 seconds
            }

            // Get ID of last message in the DOM
            function getLastMessageId() {
                const messages = document.querySelectorAll('.chat-message[data-message-id]');
                if (messages.length > 0) {
                    return messages[messages.length - 1].dataset.messageId;
                }
                return '';
            }

            // Update user status periodically
            setInterval(() => {
                fetch('/chat/status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }, 30000); // Every 30 seconds
        });
    </script>
@endpush
