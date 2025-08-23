<?php
namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Post;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    // Show form to add performance data
    public function create()
    {
        $staffs = Post::all();
        return view('performances.create', compact('staffs'));
    }

    // Store performance data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:posts,id',
            'performance_metric' => 'required|string|max:255',
            'score' => 'required|integer|min:0|max:10',
            'comments' => 'nullable|string',
            'date' => 'required|date',
        ]);

        Performance::create($validated);

        return redirect()->route('performances.index')->with('success', 'Performance data added!');
    }

    // List performance data
    public function index()
    {
        $performances = Performance::with('staff')->latest()->paginate(10);
        return view('performances.index', compact('performances'));
    }

    // AI-generated performance report
    public function report($staffId)
    {
        $staff = Post::findOrFail($staffId);
        $performances = $staff->performances()->get();

        // Example: Calculate average score and generate AI-like comments
        $averageScore = $performances->avg('score');

        $performanceSummary = $this->generateAiReport($averageScore);

        return view('performances.report', compact('staff', 'performances', 'averageScore', 'performanceSummary'));
    }

    // AI logic for performance report
    private function generateAiReport($avgScore)
    {
        if ($avgScore >= 8) {
            return "Excellent performance. Keep up the great work!";
        } elseif ($avgScore >= 5) {
            return "Good performance but some improvements are needed.";
        } else {
            return "Performance needs improvement. Training and support recommended.";
        }
    }

    // Salary Calculation
    public function calculateSalary($staffId)
    {
        $staff = Post::findOrFail($staffId);
        
        // Let's assume base salary stored in staff table
        $baseSalary = $staff->base_salary ?? 30000;

        // Average performance score affects bonus: 
        $avgScore = $staff->performances()->avg('score') ?? 0;

        // bonus formula: bonus = 10% of base salary if avgScore >= 8, 5% if >=5 else 0
        $bonus = 0;
        if ($avgScore >= 8) {
            $bonus = $baseSalary * 0.1;
        } elseif ($avgScore >= 5) {
            $bonus = $baseSalary * 0.05;
        }

        // Calculate salary = baseSalary + bonus
        $totalSalary = $baseSalary + $bonus;

        return view('performances.salary', compact('staff', 'baseSalary', 'bonus', 'totalSalary', 'avgScore'));
    }
}

