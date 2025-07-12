<?php

namespace App\Providers;

use Domain\Auth\Services\AuthTokenServiceInterface;
use Domain\Booking\Repositories\BookingRepositoryInterface;
use Domain\Resource\QueryFilters\ResourceQueryFilterInterface;
use Domain\Resource\Repositories\ResourceRepositoryInterface;
use Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Auth\Services\AuthTokenService;
use Infrastructure\Resource\QueryFilters\ResourceQueryFilter;
use Infrastructure\Booking\Repositories\BookingRepository;
use Infrastructure\Resource\Repositories\ResourceRepository;
use Infrastructure\User\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(
            ResourceRepositoryInterface::class,
            ResourceRepository::class
        );

        app()->bind(
            ResourceQueryFilterInterface::class,
                ResourceQueryFilter::class
        );

        app()->bind(
            BookingRepositoryInterface::class,
            BookingRepository::class
        );

        app()->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        app()->singleton(
            AuthTokenServiceInterface::class,
            AuthTokenService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
