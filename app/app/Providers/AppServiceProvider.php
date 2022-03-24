<?php

namespace App\Providers;

use App\Models\Gender;
use App\Models\Kind;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
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

        view()->composer(['card.create', 'pet.add'], function ($view) {
            $view->with('genders', Gender::all());
            $view->with('kinds', Kind::all());
        });

        view()->composer('home.index', function ($view) {
            $view->with('petCount', DB::table('pets')->count());
            $view->with('ownerCount', DB::table('owners')->count());
            $view->with('visitCount', DB::table('visits')->count());
        });
    }
}
