<?php

namespace App\Providers;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\BlogRepository;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\InquiryRepository;
use App\Repositories\ReservationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(InquiryRepositoryInterface::class, InquiryRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
