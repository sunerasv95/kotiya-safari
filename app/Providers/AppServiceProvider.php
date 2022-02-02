<?php

namespace App\Providers;

use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\InquiryServiceInterface;
use App\Services\Contracts\ReservationServiceInterface;
use App\Services\AuthService;
use App\Services\BlogService;
use App\Services\Contracts\BlogServiceInterface;
use App\Services\Contracts\StorageServiceInterface;
use App\Services\InquiryService;
use App\Services\ReservationService;
use App\Services\StorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(InquiryServiceInterface::class, InquiryService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
        $this->app->bind(BlogServiceInterface::class, BlogService::class);

        $this->app->bind(StorageServiceInterface::class, StorageService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
