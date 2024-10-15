<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/',[HomeController::class,'home']);
Route::get('home',[HomeController::class,'index'])->middleware(['auth', 'verified']);



Route::get('assignedTeacher/{id}',[AdminController::class,'assignedTeacher'])->middleware('auth','admin');
Route::get('admin',[AdminController::class,'index'])->middleware('auth','admin');
Route::get('create_routine',[AdminController::class,'create_routine'])->middleware('auth','admin');
Route::post('confirm_routine',[AdminController::class,'confirm_routine'])->middleware('auth','admin');
Route::get('manage_special_day',[AdminController::class,'manage_special_day'])->middleware('auth','admin');
Route::post('add_special_date',[AdminController::class,'add_special_date'])->middleware('auth','admin');
Route::get('clear_data',[AdminController::class,'clear_data'])->middleware('auth','admin');
Route::get('add_allholiday',[AdminController::class,'add_allholiday'])->middleware('auth','admin');
Route::post('store_all_holiday',[AdminController::class,'store_all_holiday'])->middleware('auth','admin');
Route::get('show_routine',[AdminController::class,'show_routine'])->middleware('auth','admin');
Route::get('print_routine/{id}',[AdminController::class,'print_routine'])->middleware('auth','admin');
Route::post('student_req',[AdminController::class,'student_req'])->middleware('auth','verified');

