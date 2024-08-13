<?php

namespace App\Providers;

use App\Repositories\CarrierGroupRepository;
use App\Repositories\Interfaces\CarrierGroupRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CarrierGroupRepositoryInterface::class, CarrierGroupRepository::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
