<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\GeneralNotification;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    /**
     * Show the notification form
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Send notification email to all staff
     */
    public function sendNotification(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $staffList = Post::all();

        foreach ($staffList as $staff) {
            if ($staff->email) {
                Mail::to($staff->email)->send(
                    new GeneralNotification(
                        $request->subject,
                        $request->message
                    )
                );
            }
        }

        return back()->with('success', 'Notification sent to all staff.');
    }
}

