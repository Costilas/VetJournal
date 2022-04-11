<?php

namespace App\Providers;

use App\Services\PasswordService;
use App\Services\VisitService;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('password.service', fn () => new PasswordService());
        $this->app->bind('visit.service', fn () => new VisitService());
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
