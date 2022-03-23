<?php

namespace App\Providers;

use App\Models\Gender;
use App\Models\Kind;
use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('card.create', function ($view) {
            $view->with('genders', Gender::all());
            $view->with('kinds', Kind::all());
        });
    }
}
