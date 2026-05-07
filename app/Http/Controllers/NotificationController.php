<?php
namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        $notifications->whereNull('read_at')->each(fn($n) => $n->update(['read_at' => now()]));
        return view('notifications.index', compact('notifications'));
    }

    public function unreadCount()
    {
        return response()->json([
            'count' => Notification::where('user_id', auth()->id())
                                   ->whereNull('read_at')
                                   ->count()
        ]);
    }
}