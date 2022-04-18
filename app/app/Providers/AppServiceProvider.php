<?php

namespace App\Providers;

use App\Models\Gender;
use App\Models\Kind;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
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

        view()->composer(['card.create', 'owner.pet.forms.add', 'pet.edit'], function ($view) {
            $view->with('genders', Gender::all());
            $view->with('kinds', Kind::all());
        });

        view()->composer(['pet.visit.forms.create', 'visit.edit'], function ($view) {
            $view->with('doctors', User::where('is_active', '=', 1)->where('is_dev','!=', 1)->get());
        });

        Blade::directive('createDate', function (string $when) {
            try{
               $date =  Carbon::createFromFormat('d-m-Y',$when)->toDateString();
               if(!$date){throw new \Exception();}
            }catch(\Exception $e) {
                $date = Carbon::createFromFormat('d-m-Y','yesterday')->toDateString();
            }

            return $date;
        });

    }
}
