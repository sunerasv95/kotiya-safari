<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingInquiryController;
use App\Http\Controllers\GuestBookingController;
use App\Http\Controllers\GuestInquiryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*
 *******************************************************************************
 * **************** GUEST ROUTES ***********************************************
 *******************************************************************************
*/

Route::get('/', [HomeController::class, "homePage"])->name('home');

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, "fetchAllPosts"])->name('blog');
    Route::get('{postSlug}', [BlogController::class, "showPost"])->name('show-blog');
});

Route::prefix('inquiry')->group(function () {
    Route::get('/', [GuestInquiryController::class, "inquiry"])
        ->name('reservation-request');

    Route::post("submitRequest", [GuestInquiryController::class, "storeInquiry"])
        ->name('submit-reservation-request');
});

Route::prefix('reservations')->group(function () {
    Route::get('activate', [GuestBookingController::class, "index"])
        ->name('activate-reservation');
    Route::get('verification', [GuestBookingController::class, "verifyCode"])
        ->name('verify-reservation');
    Route::get('summary', [GuestBookingController::class, "summary"])
        ->name('reservation-summary');
    Route::get('checkout/pid={checkoutSessId}', [GuestBookingController::class, "checkout"])
        ->name('checkout-reservation');

    Route::post("verifyEmail", [GuestBookingController::class, "verifyEmail"])
        ->name('submit-verify-email');
    Route::post("verifyReservation", [GuestBookingController::class, "verifyBooking"])
        ->name('submit-verify-reservation');
    Route::post("submitPayAmount", [GuestBookingController::class, "payAmount"])
        ->name('submit-checkout');
});


/*
 *******************************************************************************
 * **************** ADMIN ROUTES ***********************************************
 *******************************************************************************
*/

//***** PUBLIC ROUTES

Route::prefix('/cn/admin')->group(function () {
    Route::get('/', [AuthController::class, "login"])->name('admin-login');
    Route::post('auth/signIn', [AuthController::class, "submitSignIn"])->name('submit-signin');
});

//**** AUTHORIZED ROUTES
Route::prefix('/cn/admin')
    //->middleware('userCheck')
    ->group(function () {

        Route::get('auth/signOut', [AuthController::class, "submitSignOut"])->name('submit-signout');

        Route::get('dashboard', [DashboardController::class, "index"])->name('dashboard');

        Route::prefix('inquiries')->group(function () {
            Route::get('/', [InquiryController::class, "findAll"])->name('list-inquiries');
            Route::get('filter/{status?}', [InquiryController::class, "findAllByStatus"])->name('filter-inquiries');
            Route::get('create', [InquiryController::class, "createInquiry"])->name('create-inquiry');
            Route::get('{inquiryId}', [InquiryController::class, "findByReferenceNumber"])->name('view-inquiry');

            Route::post('createInquiry', [InquiryController::class, "saveInquiry"])->name('create-inquiry-submit');
            Route::post('updateInquiry', [InquiryController::class, "update"])->name('update-inquiry-submit');
            Route::post('rejectInquiry', [InquiryController::class, "reject"])->name('reject-inquiry-submit');
        });

        Route::prefix('reservations')->group(function () {
            Route::get('/', [ReservationController::class, "findAll"])->name('list-reservations');
            Route::get('{bkRefId}', [ReservationController::class, "findByReferenceNumber"])->name('view-reservation');

            Route::post('inquiryRequest', [ReservationController::class, "storeReservationRequest"])->name('store-reservation-order-request');
        });

        Route::prefix('blog-posts')->group(function () {
            Route::get('/', [BlogPostController::class, "findAll"])->name('list-blog-posts');
            Route::get('create', [BlogPostController::class, "createPost"])->name('create-post');

            Route::post('store', [BlogPostController::class, "storePost"])->name('store-post');
            // Route::get('create', [ReservationController::class, "findAll"])->name('create-reservation');
            // Route::get('{bkRefId}', [ReservationController::class, "findByReferenceNumber"])->name('view-reservation');
        });
        Route::prefix('files')->group(function () {
            Route::post('images/upload', [FileUploadController::class, "uploadImage"])->name('image-upload');
            Route::post('images/remove', [FileUploadController::class, "removeImage"])->name('remove-image');
        });
    });
