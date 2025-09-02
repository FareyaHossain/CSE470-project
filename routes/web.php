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
// handle add staff
Route::get('/', function () {
    return view('welcome',['posts'=>post::all()]);
})->name('home');

Route::get('/create', [postController::class, 'create']);
Route::post('/store', [postController::class, 'ourfilestore'])->name('store');

Route::get('/edit', [postController::class, 'editData'])->name('edit');

// Show the edit form for a specific staff
Route::get('/edit/{id}', [postController::class, 'editData'])->name('edit');

// Handle the form update
Route::post('/update/{id}', [postController::class, 'updateData'])->name('update');

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





