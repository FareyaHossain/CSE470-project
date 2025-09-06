<?php
use App\Models\post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\EmailNotificationController;
use Illuminate\Support\Facades\Mail;
use App\Mail\StaffNotificationMail;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// OTP Verification
Route::get('/otp', [AuthController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard (protected by auth middleware)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', function () {
    $posts = Post::all(); // fetch all staff
    return view('dashboard', compact('posts'));
})->middleware('auth')->name('dashboard');

// handle add staff
Route::get('/', function () {
    return view('welcome',['posts'=>post::all()]);
})->name('dashboard');

Route::resource('staff', PostController::class)->middleware('auth');

Route::get('/create', [postController::class, 'create']);
Route::post('/store', [postController::class, 'ourfilestore'])->name('store');

Route::get('/edit', [postController::class, 'editData'])->name('edit');

// Show the edit form for a specific staff
Route::get('/edit/{id}', [postController::class, 'editData'])->name('edit');

// Handle the form update
Route::post('/update/{id}', [postController::class, 'updateData'])->name('update');
Route::put('/update/{id}', [PostController::class, 'updateData'])->name('update');
Route::get('/update/{id}', [PostController::class, 'updateData'])->name('update');

//Handle the delete form
Route::delete('/delete/{id}', [PostController::class, 'deleteData'])->name('delete');
//handle leave request

Route::get('/leave-request', [LeaveRequestController::class, 'create'])->name('leave.create');
Route::post('/leave-request', [LeaveRequestController::class, 'store'])->name('leave.store');
Route::get('/leave/manage', [LeaveRequestController::class, 'index'])->name('leave.index');

Route::get('/leave/approve/{id}', [LeaveRequestController::class, 'approve'])->name('leave.approve');
Route::get('/leave/deny/{id}', [LeaveRequestController::class, 'deny'])->name('leave.deny');

Route::put('/leave/approve/{id}', [LeaveRequestController::class, 'approve'])->name('leave.approve');
Route::put('/leave/deny/{id}', [LeaveRequestController::class, 'deny'])->name('leave.deny');

//handle attendance
Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/monthly-report', [AttendanceController::class, 'monthlyReport'])->name('attendance.monthly_report');


//handle performance, AI report and salary calc

Route::prefix('performances')->group(function () {
    Route::get('/', [PerformanceController::class, 'index'])->name('performances.index');
    Route::get('/create', [PerformanceController::class, 'create'])->name('performances.create');
    Route::post('/', [PerformanceController::class, 'store'])->name('performances.store');
    
    Route::get('/report/{staffId}', [PerformanceController::class, 'report'])->name('performances.report');
    Route::get('/salary/{staffId}', [PerformanceController::class, 'calculateSalary'])->name('performances.salary');
});

//handle chatbot 


Route::get('/chatbot', [ChatbotController::class, 'index']);
Route::post('/chatbot/message', [ChatbotController::class, 'handle']);


// email

Route::get('/test-email', function () {
    $details = [
        'subject' => 'Important Announcement: Upcoming Holiday.',
        'title' => 'Eid Holiday',
        'body' => 'Dear staffs, Eid Holidays will start  from 15-20 August.'
                 
    ];

    Mail::to('staffmanagementhub@gmail.com')->send(new \App\Mail\StaffNotificationMail($details));
    return 'Email sent!';
});


   

