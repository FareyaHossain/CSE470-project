<?php
use App\Models\post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;


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

Route::get('/', function () {
    return view('welcome',['posts'=>post::all()]);
})->name('home');

Route::get('/create', [postController::class, 'create']);

Route::post('/store', [postController::class, 'ourfilestore'])->name('store');

//Route::get('/edit', [postController::class, 'editData'])->name('edit');

// Show the edit form for a specific staff
Route::get('/edit/{id}', [postController::class, 'editData'])->name('edit');

// Handle the form update
Route::post('/update/{id}', [postController::class, 'updateData'])->name('update');

//Handle the delete form
Route::delete('/delete/{id}', [PostController::class, 'deleteData'])->name('delete');
