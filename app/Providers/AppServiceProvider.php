<?php

namespace App\Providers;

use App\Repositories\Backend\RepositoryIoCRegister;
use App\Services\Backend\ServiceIoCRegister;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        RepositoryIoCRegister::register();
        ServiceIoCRegister::register();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
