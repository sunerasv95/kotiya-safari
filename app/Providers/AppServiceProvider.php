<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BlogService;
use App\Services\CommonService;
use App\Services\ExternalApiCallsService;
use App\Services\InquiryService;
use App\Services\ReservationService;
use App\Services\StorageService;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\InquiryServiceInterface;
use App\Services\Contracts\ReservationServiceInterface;
use App\Services\Contracts\BlogServiceInterface;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\ExternalApiCallsServiceInterface;
use App\Services\Contracts\StorageServiceInterface;
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

        $this->app->bind(ExternalApiCallsServiceInterface::class, ExternalApiCallsService::class);
        $this->app->bind(CommonServiceInterface::class, CommonService::class);



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
