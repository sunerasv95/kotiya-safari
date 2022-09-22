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

Route::get('/', [HomeController::class, "homePage"])
    ->name('home');

Route::get('/blogs', [BlogController::class, "fetchAllPosts"])
    ->name('guest.blogs');

Route::get('/blogs/{postSlug}', [BlogController::class, "showPost"])
    ->name('guest.blogs.show');

Route::get('inquiries', [GuestInquiryController::class, "inquiry"])
        ->name('guest.inquiries.request');

Route::post("inquiries/submitRequest", [GuestInquiryController::class, "storeInquiry"])
        ->name('guest.inquiries.request.submit');

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

    Route::get('/', [AuthController::class, "login"])
        ->name('admin.login');

    Route::post('auth/signIn', [AuthController::class, "submitSignIn"])
        ->name('admin.login.submit');

});

//**** AUTHORIZED ROUTES

Route::prefix('/cn/admin')
    //->middleware('userCheck')
    ->group(function () {

        Route::get('auth/signOut', [AuthController::class, "submitSignOut"])
            ->name('admin.auth.signout.submit');

        Route::get('dashboard', [DashboardController::class, "index"])
            ->name('admin.dashboard');

        Route::prefix('inquiries')->group(function () {

            Route::get('/', [InquiryController::class, "findAll"])
                ->name('admin.inquiries');

            Route::get('filter/{status?}', [InquiryController::class, "findAllByStatus"])
                ->name('admin.inquiries.filter');

            Route::get('create', [InquiryController::class, "createInquiry"])
                ->name('admin.inquiries.create');

            Route::get('{inquiryId}', [InquiryController::class, "findByReferenceNumber"])
                ->name('admin.inquiries.view');

            Route::post('createInquiry', [InquiryController::class, "saveInquiry"])
                ->name('admin.inquiries.create.submit');

            Route::post('updateInquiry', [InquiryController::class, "update"])
                ->name('admin.inquiries.update.submit');

            Route::post('rejectInquiry', [InquiryController::class, "reject"])
                ->name('admin.inquiries.reject.submit');

        });

        Route::prefix('reservations')->group(function () {

            Route::get('/', [ReservationController::class, "findAll"])
                ->name('admin.reservations');

            Route::get('{bkRefId}', [ReservationController::class, "findByReferenceNumber"])
                ->name('admin.reservations.view');

            Route::post('inquiryRequest', [ReservationController::class, "storeReservationRequest"])
                ->name('store-reservation-order-request');
        });

        Route::prefix('blog-posts')->group(function () {

            Route::get('/', [BlogPostController::class, "findAll"])
                ->name('admin.blogs');

            Route::get('create', [BlogPostController::class, "createPost"])
                ->name('admin.blogs.create');

            Route::post('store', [BlogPostController::class, "storePost"])
                ->name('admin.blogs.create.submit');
            
        });

        Route::prefix('files')->group(function () {
            Route::prefix('images')->group(function(){

                Route::post('upload', [FileUploadController::class, "uploadImage"])
                    ->name('admin.uploads.images.submit');

                Route::post('remove', [FileUploadController::class, "removeImage"])
                    ->name('admin.uploads.images.remove');

            });
           
        });
    });
