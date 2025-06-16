<?php

use App\Http\Controllers\Admin\AboutUsSectionController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\BecomeInstructorSectionController;
use App\Http\Controllers\Admin\BrandSectionController;
use App\Http\Controllers\Admin\CertificateBuilderController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CourseLanguageController;
use App\Http\Controllers\Admin\CourseLevelController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseSubCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Admin\LatestCourseSectionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PayoutGatewayController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\VideoSectionController;
use App\Http\Controllers\Admin\WithdrawRequestController;
use App\Http\Controllers\Admin\FeaturedInstructorSectionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\HeroController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "guest:admin", "prefix" => "admin", "as" => "admin."], function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');


});

Route::group(["middleware" => "auth:admin", "prefix" => "admin", "as" => "admin."], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*******************************************************
     * INSTRUCTOR REQUESTS ROUTES START
     *******************************************************/
    Route::get('/instructor-doc-downloads/{user}', [InstructorRequestController::class, 'downloadDoc'])->name('instructor_doc_downloads');
    Route::resource('instructor-requests', InstructorRequestController::class);
    /*******************************************************
     * COURSE LANGUAGES ROUTES START
     *******************************************************/
    Route::resource('course-languages', CourseLanguageController::class);
    /*******************************************************
     * COURSE LEVELS ROUTES START
     *******************************************************/
    Route::resource('course-levels', CourseLevelController::class);
    /*******************************************************
     * COURSE CATEGORIES ROUTES START
     *******************************************************/
    Route::resource('course-categories', CourseCategoryController::class);
    Route::get('/{course_category}/sub-categories', [CourseSubCategoryController::class, 'index'])->name('course-sub-categories.index');
    Route::get('/{course_category}/sub-categories/create', [CourseSubCategoryController::class, 'create'])->name('course-sub-categories.create');
    Route::post('/{course_category}/sub-categories', [CourseSubCategoryController::class, 'store'])->name('course-sub-categories.store');
    Route::get('/{course_category}/sub-categories/{course_sub_category}/edit', [CourseSubCategoryController::class, 'edit'])->name('course-sub-categories.edit');
    Route::put('/{course_category}/sub-categories/{course_sub_category}', [CourseSubCategoryController::class, 'update'])->name('course-sub-categories.update');
    Route::delete('/{course_category}/sub-categories/{course_sub_category}', [CourseSubCategoryController::class, 'destroy'])->name('course-sub-categories.destroy');
    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * COURSE ROUTE START
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::put('/courses/{course_id}/update-approval', [CourseController::class, 'update_approval'])->name('courses.update_approval');
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
     *  ORDERS ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order_id}/show', [OrderController::class, 'show'])->name('orders.show');

    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * PAYMENT SETTINGS ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::post('/payment-settings/paypal', [PaymentSettingController::class, 'paypal_store'])->name('payment-settings.paypal');
    Route::post('/payment-settings/stripe', [PaymentSettingController::class, 'stripe_store'])->name('payment-settings.stripe');
    Route::post('/payment-settings/razorpay', [PaymentSettingController::class, 'razorpay_store'])->name('payment-settings.razorpay');

    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * SITE SETTINGS ROUTE
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::get('/site-settings', [SettingController::class, 'index'])->name('site-settings.index');
    Route::post('/update-general-settings', [SettingController::class, 'updateGeneralSettings'])->name('site-settings.update-general-settings');
    // commission settings
    Route::get('/commission-settings', [SettingController::class, 'commissionSettings'])->name('site-settings.commission-settings');
    Route::post('/update-commission-settings', [SettingController::class, 'updateCommissionSettings'])->name('site-settings.update-commission-settings');
    // smtp-settings
    Route::get('/smtp-settings', [SettingController::class, 'smtpSettings'])->name('site-settings.smtp-settings');
    Route::post('/update-smtp-settings', [SettingController::class, 'updateSmtpSettings'])->name('site-settings.update-smtp-settings');
    // payout settings resource
    Route::resource('payout-gateways', PayoutGatewayController::class);
    // withdraw request
    Route::get('/withdraw-request', [WithdrawRequestController::class, 'index'])->name('withdraw-request.index');
    Route::get('/withdraw-request/{withdraw}/show', [WithdrawRequestController::class, 'show'])->name('withdraw-request.show');
    Route::post('/withdraw-request/{withdraw}/status', [WithdrawRequestController::class, 'updateStatus'])->name('withdraw-request.update-status');

    Route::get('/certificate-builder', [CertificateBuilderController::class, 'index'])->name('certificate-builder.index');
    Route::post('/certificate-builder/store', [CertificateBuilderController::class, 'store'])->name('certificate-builder.store');
    Route::post('/certificate-builder/update-position', [CertificateBuilderController::class, 'updatePosition'])->name('certificate-builder.update-position');


    Route::resource('/hero', HeroController::class);
    Route::resource('/features', FeatureController::class);
    Route::resource('/about-section', AboutUsSectionController::class);
    Route::resource('/latest-courses', LatestCourseSectionController::class);
    Route::resource('/become-instructor', BecomeInstructorSectionController::class);
    Route::resource('/video-section', VideoSectionController::class);
    Route::resource('/brand-section', controller: BrandSectionController::class);

    Route::get('/get-instructor-courses/{instructor_id}', [FeaturedInstructorSectionController::class, 'getInstructorCourses'])->name('get_instructor_courses');
    Route::resource('/featured-instructor-section', FeaturedInstructorSectionController::class);
    Route::resource('/testimonial-section', TestimonialController::class);
    Route::resource('/counter-section', CounterController::class);
    Route::resource('/contact-us', ContactUsController::class);
    Route::resource('/contact-setting', ContactSettingController::class);















    /**
     * ————————————————————————————————————————————————————————————————————————————————
     * LARAVEL FILE MANAGER
     * ————————————————————————————————————————————————————————————————————————————————
     */
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

