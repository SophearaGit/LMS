<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

/**
 *————————————————————————————————————————————————————————————————————————————————
 * FRONTEND ROUTE
 *————————————————————————————————————————————————————————————————————————————————
 */
Route::get('/', [FrontendController::class, 'index'])->name('home');


/**
 *————————————————————————————————————————————————————————————————————————————————
 * STUDENT ROUTE
 *————————————————————————————————————————————————————————————————————————————————
 */
 Route::group(["middleware" => ['auth', 'verified', 'check_role:student'], "prefix" => "student", "as" => "student."], function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
});

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * INSTRUCTOR ROUTE
 * ————————————————————————————————————————————————————————————————————————————————
 */
Route::group(["middleware" => ['auth', 'verified', 'check_role:instructor'], "prefix" => "instructor", "as" => "instructor."], function () {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
});


require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
