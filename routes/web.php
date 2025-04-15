<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schedule;

Schedule::command('telescope:prune --hours=48')->daily();

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
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become_instructor');
    Route::post('/become-instructor/{user}', [StudentDashboardController::class, 'becomeInstructorUpdate'])->name('become_instructor_update');
    // PROFIL UPDATE
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('prfile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePasswordProfileStore'])->name('profile.update_password');
    Route::post('/profile/update-social-link', [ProfileController::class, 'updateSocialLink'])->name('profile.update_social_link');

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
