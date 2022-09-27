<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BlogService;
use App\Services\CommonService;
use App\Services\ExternalApiCallsService;
use App\Services\InquiryService;
use App\Services\ReservationOrderService;
use App\Services\StorageService;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\InquiryServiceInterface;
use App\Services\Contracts\ReservationOrderServiceInterface;
use App\Services\Contracts\BlogServiceInterface;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\DashboardServiceInterface;
use App\Services\Contracts\ExternalApiCallsServiceInterface;
use App\Services\Contracts\NotificationServiceInterface;
use App\Services\Contracts\RoleServiceInterface;
use App\Services\Contracts\StorageServiceInterface;
use App\Services\DashboardService;
use App\Services\NotificationService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        Schema::defaultStringLength(191);

        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);

        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);
        $this->app->bind(InquiryServiceInterface::class, InquiryService::class);
        $this->app->bind(ReservationOrderServiceInterface::class, ReservationOrderService::class);
        $this->app->bind(BlogServiceInterface::class, BlogService::class);

        $this->app->bind(StorageServiceInterface::class, StorageService::class);
        $this->app->bind(NotificationServiceInterface::class, NotificationService::class);

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
        if(env('APP_ENV') != "local"){
            URL::forceScheme('https');
        }
    }
}
