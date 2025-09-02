<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Staff model
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    // Show leave request form
    public function create()
    {
        $staff = Post::all();
        return view('request', compact('staff'));
    }

    // Store leave request
    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:posts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
        ]);

        LeaveRequest::create([
            'staff_id' => $request->staff_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'Pending',
            'admin_comment' => null,
        ]);

        return redirect()->route('leave.index')->with('success', 'Leave request submitted successfully.');
    }

    // List all leave requests
    public function index()
    {
        $requests = LeaveRequest::with('staff')->orderBy('created_at', 'desc')->get();

        // Calculate recommendation for each leave request
        foreach ($requests as $request) {
              $start = \Carbon\Carbon::parse($request->start_date);
              $end   = \Carbon\Carbon::parse($request->end_date);
              $leaveDays = $start->diffInDays($end) + 1; // include both start and end date

              if ($leaveDays > 5) {
                  $request->recommendation = 'Needs Manager Approval';
              } else {
                 $request->recommendation = 'Auto-Approved';
              }
         }


        return view('manage', compact('requests'));
    }

    // Approve leave request
    public function approve($id)
    {
        $request = LeaveRequest::findOrFail($id);
        $request->update([
            'status' => 'Approved',
            'admin_comment' => 'Approved automatically',
        ]);

        return back()->with('success', 'Leave approved successfully.');
    }

    // Deny leave request
    public function deny($id)
    {
        $request = LeaveRequest::findOrFail($id);
        $request->update([
            'status' => 'Denied',
            'admin_comment' => 'Denied due to high usage',
        ]);

        return back()->with('error', 'Leave denied.');
    }
}

