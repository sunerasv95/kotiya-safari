<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\BlogController;
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

Route::get('/', [HomeController::class, "homePage"])->name('home');
Route::prefix('blog')->group(function(){
    Route::get('/', [BlogController::class, "fetchAllPosts"])->name('blog');
    Route::get('{postSlug}', [BlogController::class, "showPost"])->name('show-blog');
});

Auth::routes();

Route::prefix('/cn/admin')->group(function(){
    Route::get('/', [AuthController::class, "login"])->name('admin-login');
    Route::get('dashboard', [DashboardController::class, "index"])->name('dashboard');
    Route::prefix('inquiries')->group(function(){
        Route::get('/', [InquiryController::class, "findAll"])->name('list-inquiries');
        Route::get('{inquiryId}', [InquiryController::class, "findByReferenceNumber"])->name('view-inquiry');
    });
    Route::prefix('reservations')->group(function(){
        Route::get('/', [ReservationController::class, "findAll"])->name('list-reservations');
        Route::get('create', [ReservationController::class, "findAll"])->name('create-reservation');
        Route::get('{bkRefId}', [ReservationController::class, "findByReferenceNumber"])->name('view-reservation');
    });
    Route::prefix('blog-posts')->group(function(){
        Route::get('/', [BlogPostController::class, "findAll"])->name('list-blog-posts');
        Route::get('create', [BlogPostController::class, "createPost"])->name('create-post');

        Route::post('store', [BlogPostController::class, "storePost"])->name('store-post');
        // Route::get('create', [ReservationController::class, "findAll"])->name('create-reservation');
        // Route::get('{bkRefId}', [ReservationController::class, "findByReferenceNumber"])->name('view-reservation');
    });
    Route::prefix('files')->group(function(){
        Route::post('images/upload', [FileUploadController::class, "uploadImage"])->name('image-upload');
        Route::post('images/remove', [FileUploadController::class, "removeImage"])->name('remove-image');
    });

    Route::post('/auth/signIn', [AuthController::class, "submitSignIn"])->name('submit-signin');
});

