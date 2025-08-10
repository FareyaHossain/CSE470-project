<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function monthlyReport(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $staffList = Post::with(['attendances' => function ($query) use ($month, $year) {
            $query->whereMonth('date', $month)->whereYear('date', $year);
        }])->get();

        foreach ($staffList as $staff) {
            $present = $staff->attendances->where('status', 'Present')->count();
            $absent = $staff->attendances->where('status', 'Absent')->count();
            $leave = $staff->attendances->where('status', 'Leave')->count();
            $total = $present + $absent + $leave;
            $percentage = $total > 0 ? round(($present / $total) * 100, 2) : 0;

            $staff->present_days = $present;
            $staff->absent_days = $absent;
            $staff->leave_days = $leave;
            $staff->total_days = $total;
            $staff->attendance_percentage = $percentage;
        }

        return view('attendance.monthly_report', compact('staffList', 'month', 'year'));
    }

    public function create()
    {
        $staffs = Post::all();
        return view('attendance.create', compact('staffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:posts,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent,Leave',
        ]);

        Attendance::create([
            'staff_id' => $request->staff_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        $month = Carbon::parse($request->date)->month;
        $year = Carbon::parse($request->date)->year;

        return redirect()->route('attendance.monthly_report', [
            'month' => $month,
            'year' => $year
        ])->with('success', 'Attendance added successfully and report updated.');
    }
}



