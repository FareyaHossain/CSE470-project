<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Post;
use App\Mail\StaffNotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class EmailNotificationController extends Controller
{
    public function approve($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->status = 'Approved';
        $leave->save();

        $staff = Post::find($leave->post_id);
        if (!$staff) {
            return redirect()->back()->with('error', 'Staff not found.');
        }

        $subject = "Leave Request Approved";
        $body = "Dear {$staff->name}, your leave from {$leave->start_date} to {$leave->end_date} has been approved.";

        Mail::to($staff->email)->send(new StaffNotificationMail($subject, $body));

        return redirect()->back()->with('success', 'Leave approved and email sent.');
    }
}







