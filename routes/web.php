<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\PaymentController;
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

// COURSE PAGE START
Route::get('/courses', [CoursePageController::class, 'getCoursePage'])->name('courses');
Route::get('/courses/{slug}', [CoursePageController::class, 'getcoursedetailpage'])->name('courses.show');

// CART PAGE START
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{course_id}/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/{cart_id}/delete', [CartController::class, 'destroy'])->name('cart.destroy');

// CHECKOUT PAGE START
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// PAYMENT ROUTE START
Route::get('/payment/paypal', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
Route::get('/payment/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/payment/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
Route::get('/payment/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
Route::get('/order-success', [PaymentController::class, 'orderSuccess'])->name('order.success');
Route::get('/order-fail', [PaymentController::class, 'orderFail'])->name('order.fail');

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
    // PROFIL UPDATE
    Route::get('/profile', [ProfileController::class, 'instructorProfile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('prfile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePasswordProfileStore'])->name('profile.update_password');
    Route::post('/profile/update-social-link', [ProfileController::class, 'updateSocialLink'])->name('profile.update_social_link');
    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * COURSE ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses/store-basic-info', action: [CourseController::class, 'storeBasicInfo'])->name('courses.store_basic_info');
    Route::get('/courses/{id}/edit-basic-info', [CourseController::class, 'editBasicInfo'])->name('courses.edit_basic_info');
    Route::post('/courses/update-more-info', action: [CourseController::class, 'updateMoreInfo'])->name('courses.update_more_info');
    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * COURSE CHAPTER ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/course-content/{course_id}/create-chapter', [CourseContentController::class, 'createChapterModal'])->name('course-content.create-chapter');
    Route::post('/course-content/{course_id}/create-chapter', [CourseContentController::class, 'storeChapterModal'])->name('course-content.store-chapter');
    Route::get('/course-content/{chapter_id}/edit-chapter', [CourseContentController::class, 'editChapterModal'])->name('course-content.edit-chapter');
    Route::post('/course-content/{chapter_id}/edit-chapter', [CourseContentController::class, 'updateChapterModal'])->name('course-content.update-chapter');
    Route::delete('/course-content/{chapter_id}/delete-chapter', [CourseContentController::class, 'deleteChapterModal'])->name('course-content.delete-chapter');
    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * COURSE LESSON ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/course-content/create-lesson', [CourseContentController::class, 'createLessonModal'])->name('course-content.create-lesson');
    Route::post('/course-content/create-lesson', [CourseContentController::class, 'storeLessonModal'])->name('course-content.store-lesson');
    Route::get('/course-content/edit-lesson', [CourseContentController::class, 'editLessonModal'])->name('course-content.edit-lesson');
    Route::post('/course-content/{id}/update-lesson', [CourseContentController::class, 'updateLessonModal'])->name('course-content.update-lesson');
    Route::delete('/course-content/{id}/delete-lesson', [CourseContentController::class, 'deleteLessonModal'])->name('course-content.delete-lesson');
    // SORT LESSON ROUTE
    Route::post('/course-chapter/{chapter_id}/sort-lesson', [CourseContentController::class, 'sortLesson'])->name('course-chapter.sort-lesson');
    // SORT CHAPTER ROUTE
    Route::get('/course-content/{course_id}/sort-chapter', [CourseContentController::class, 'sortChapter'])->name('course-content.sort-chapter');
    Route::post('/course-content/{course_id}/sort-chapter', [CourseContentController::class, 'UpdateSortChapter'])->name('course-content.update-sort-chapter');

    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * LARAVEL FILE MANAGER
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

});


require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
