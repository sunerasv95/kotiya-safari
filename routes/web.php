<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Guest\BookingController as GuestBookingController;
use App\Http\Controllers\Guest\InquiryController as GuestInquiryController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
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

Route::get('notify', [GuestHomeController::class, "testnotify"]);


Route::get('/', [GuestHomeController::class, "homePage"])
    ->name('guest.home');

Route::get('accommodations', [GuestHomeController::class, "accommmadationPage"])
    ->name('guest.accommodations');

Route::get('aboutus', [GuestHomeController::class, "aboutusPage"])
    ->name('guest.aboutus');

Route::get('/', [GuestHomeController::class, "homePage"])
->name('guest.home');

Route::get('gallery', [GuestHomeController::class, "galleryPage"])
    ->name('guest.gallery');

Route::get('packages', [GuestHomeController::class, "packagesPage"])
    ->name('guest.packages');

Route::get('contact', [GuestHomeController::class, "contactUsPage"])
    ->name('guest.contact');

Route::get('journals', [GuestHomeController::class, "blogsPage"])
    ->name('guest.blogs');

Route::get('journals/{postSlug}', [GuestHomeController::class, "showPost"])
    ->name('guest.blogs.show');

Route::get('learn/about-park', [GuestHomeController::class, "learnAboutParkPage"])
    ->name('guest.learn.about-park');

Route::get('inquiries', [GuestInquiryController::class, "inquiry"])
    ->name('guest.inquiries.request');

Route::get('terms-and-conditions', [GuestHomeController::class, "termsCondtionsPage"])
    ->name('guest.terms-conditions');

Route::get('acknowledgement', [GuestHomeController::class, "acknowledgement"])
    ->name('guest.acknowledgement');

//requests

//get
Route::get('guest/countries', [GuestHomeController::class, "getCountries"])
    ->name('guest.countries.fetch');

//post
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

    Route::get('login', [AuthController::class, "login"])
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

        Route::get('/', [DashboardController::class, "index"])
            ->name('admin.dashboard');


        Route::prefix('roles')->group(function(){

            Route::get('create', [RoleController::class, "createRole"])
                ->name('admin.roles.create');

            Route::get('{roleCode}', [RoleController::class, "showRole"])
                ->name('admin.roles.view');

            Route::get('{roleCode}/edit', [RoleController::class, "editRole"])
                ->name('admin.roles.edit');

            Route::get('/{roleCode}/permissions', [RoleController::class, "getRole"])
                ->name('admin.roles.permissions');

            Route::get('/', [RoleController::class, "findAll"])
                ->name('admin.roles');


            Route::post('createRole', [RoleController::class, "save"])
                ->name('admin.roles.create.submit');

            Route::post('updateRole', [RoleController::class, "update"])
                ->name('admin.roles.update.submit');

        });


        Route::prefix('inquiries')->group(function () {

            Route::get('/', [InquiryController::class, "findAll"])
                ->name('admin.inquiries');

            Route::get('filter/{status?}', [InquiryController::class, "filter"])
                ->name('admin.inquiries.filter');

            Route::get('create', [InquiryController::class, "createInquiry"])
                ->name('admin.inquiries.create');

            Route::get('{inquiryId}', [InquiryController::class, "findOne"])
                ->name('admin.inquiries.view');

            Route::post('createInquiry', [InquiryController::class, "save"])
                ->name('admin.inquiries.create.submit');

            Route::post('updateInquiry', [InquiryController::class, "update"])
                ->name('admin.inquiries.update.submit');

            Route::post('rejectInquiry', [InquiryController::class, "reject"])
                ->name('admin.inquiries.reject.submit');
        });

        Route::prefix('reservations')->group(function () {

            Route::get('/', [ReservationController::class, "findAll"])
                ->name('admin.reservations');

            Route::get('filter/{status?}', [ReservationController::class, "filter"])
                ->name('admin.reservations.filter');

            Route::get('{reference}', [ReservationController::class, "findOne"])
                ->name('admin.reservations.view');

            Route::post('inquiryRequest', [ReservationController::class, "store"])
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
            Route::prefix('images')->group(function () {

                Route::post('upload', [FileUploadController::class, "uploadImage"])
                    ->name('admin.uploads.images.submit');

                Route::post('remove', [FileUploadController::class, "removeImage"])
                    ->name('admin.uploads.images.remove');
            });
        });
    });


