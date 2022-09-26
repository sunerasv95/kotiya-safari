<?php

namespace App\Providers;

use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\ReservationOrderRepositoryInterface;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\BlogRepository;
use App\Repositories\InquiryRepository;
use App\Repositories\ReservationOrderRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(InquiryRepositoryInterface::class, InquiryRepository::class);
        $this->app->bind(ReservationOrderRepositoryInterface::class, ReservationOrderRepository::class);
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
