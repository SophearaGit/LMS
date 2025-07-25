<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Frontend\EnrolledCourseController;
use App\Http\Controllers\Frontend\FrontendContactController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\WithdrawController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schedule;

Schedule::command('telescope:prune --hours=48')->daily();

/**
 *————————————————————————————————————————————————————————————————————————————————
 * FRONTEND ROUTE
 *————————————————————————————————————————————————————————————————————————————————
 */
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'getAboutUs'])->name('home.about');
Route::get('/contact-us', [FrontendContactController::class, 'getContactUs'])->name('home.contact_us');
Route::post('/contact-us', [FrontendContactController::class, 'sendMail'])->name('send.contact');
Route::get('/page/{slug}', [FrontendController::class, 'customPage'])->name('custom_page');
Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'getBlogDetail'])->name('blog.detail');
Route::post('/blog/{id}/comment', [BlogController::class, 'storeComment'])->name('blog.comment.store');

// COURSE PAGE START
Route::get('/courses', [CoursePageController::class, 'getCoursePage'])->name('courses');
Route::get('/courses/{slug}', [CoursePageController::class, 'getcoursedetailpage'])->name('courses.show');
Route::post('/review', [CoursePageController::class, 'sendReview'])->name('send.review');

// CART PAGE START
Route::group(['middleware' => ['auth', 'verified', 'check_role:student']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{course_id}/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/{cart_id}/delete', [CartController::class, 'destroy'])->name('cart.destroy');
});

// CHECKOUT PAGE START
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// PAYMENT ROUTE START
Route::get('/payment/paypal', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
Route::get('/payment/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/payment/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

Route::get('/stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
Route::get('/stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('/stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

Route::get('/razorpay/redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay.redirect');
Route::post('/razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');

Route::get('/order-success', [PaymentController::class, 'orderSuccess'])->name('order.success');
Route::get('/order-fail', [PaymentController::class, 'orderFail'])->name('order.fail');

Route::post('/newsletter/subscribe', [FrontendController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// ABOUT PAGE START

/**
 *————————————————————————————————————————————————————————————————————————————————
 * STUDENT ROUTE
 *————————————————————————————————————————————————————————————————————————————————
 */
Route::group(["middleware" => ['auth', 'verified'], "prefix" => "student", "as" => "student."], function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become_instructor');
    Route::post('/become-instructor/{user}', [StudentDashboardController::class, 'becomeInstructorUpdate'])->name('become_instructor_update');
    Route::get('/reviews', [StudentDashboardController::class, 'getReview'])->name('reviews.index');
    Route::delete('/reviews/{review}/delete', [StudentDashboardController::class, 'deleteReview'])->name('reviews.delete');

    // PROFIL UPDATE
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('prfile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePasswordProfileStore'])->name('profile.update_password');
    Route::post('/profile/update-social-link', [ProfileController::class, 'updateSocialLink'])->name('profile.update_social_link');
    // ENROLL COURSES ROUTE
    Route::get('/enroll-courses', [EnrolledCourseController::class, 'index'])->name('enroll_courses.index');
    Route::get('/enroll-courses/{slug}/course-videos', [EnrolledCourseController::class, 'enrolledCourseVideos'])->name('enroll_courses.course_videos');
    Route::get('/enroll-courses/get-lesson-content', [EnrolledCourseController::class, 'getLessonContent'])->name('enroll_courses.get_lesson_content');
    Route::post('/enroll-courses/update-watch-history', [EnrolledCourseController::class, 'updateWatchHistory'])->name('enroll_courses.update_watch_history');
    Route::post('/enroll-courses/update-lesson-completion', [EnrolledCourseController::class, 'updateLessonCompletion'])->name('enroll_courses.update_lesson_completion');
    Route::get('/enroll-courses/{lesson_id}/download-file', [EnrolledCourseController::class, 'downloadFile'])->name('enroll_courses.download_file');
    // CERTIFICATE ROUTE
    Route::get('/certificate/{course}/download', [CertificateController::class, 'download'])->name('certificate.download');

    // review









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
    Route::post('/profile/update-payout', [ProfileController::class, 'updatePayout'])->name('profile.update_payout');
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
     * ORDERS ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * WITHDRAW ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/withdraws', [WithdrawController::class, 'index'])->name('withdraws.index');
    Route::get('/withdraws/request-payout', [WithdrawController::class, 'requestPayout'])->name('withdraws.request_payout');
    Route::post('/withdraws/request-payout', [WithdrawController::class, 'requestPayoutStore'])->name('withdraws.request_payout_store');


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
