<?php

namespace App\Http\Controllers\Modul\Umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mark a notification as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = Auth::user()->notifications->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }

    /**
     * Mark all notifications as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markAllAsRead(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }
    
    /**
     * Get notifications for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getNotifications(Request $request)
    {
        $notifications = Auth::user()->notifications
            ->latest()
            ->take(10)
            ->get();
            
        $unreadCount = Auth::user()->unreadNotifications->count();
        
        if ($request->ajax()) {
            return response()->json([
                'notifications' => $notifications,
                'unreadCount' => $unreadCount
            ]);
        }
        
        return view('modul.umum.notifications.index', compact('notifications', 'unreadCount'));
    }
    
    /**
     * Get notifications via AJAX for polling
     */
    public function getNotificationsJson()
    {
        $notifications = auth()->user()->notifications()->latest()->take(10)->get();
        $unreadCount = auth()->user()->unreadNotifications()->count();
        
        // Transform notifications for JSON response
        $notifications = $notifications->map(function ($notification) {
            return [
                'id' => $notification->id,
                'message' => $notification->data['message'] ?? 'Notifikasi baru',
                'time' => $notification->created_at->diffForHumans(),
                'icon' => $notification->data['icon'] ?? 'default',
                'type' => $notification->data['type'] ?? 'default',
                'url' => $notification->data['url'] ?? null,
                'is_read' => $notification->read_at !== null,
            ];
        });
        
        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
    
    /**
     * Download a file from notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadFile(Request $request, $id)
    {
        $notification = Auth::user()->notifications->find($id);
        
        if (!$notification || !isset($notification->data['url'])) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
        
        // Mark notification as read
        $notification->markAsRead();
        
        // Get file URL from notification data
        $fileUrl = $notification->data['url'];
        
        // If it's a full URL, redirect to it
        if (filter_var($fileUrl, FILTER_VALIDATE_URL)) {
            return redirect($fileUrl);
        }
        
        // Extract path from URL if needed
        $path = public_path('storage/' . str_replace('/storage/', '', parse_url($fileUrl, PHP_URL_PATH)));
        
        // Check if file exists locally
        if (file_exists($path)) {
            return response()->download($path);
        }
        
        // Fallback to redirect
        return redirect($fileUrl);
    }
}
