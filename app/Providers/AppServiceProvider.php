<?php

namespace App\Providers;

use App\Http\Controllers\UserController;
use App\Models\CastrationCondition;
use App\Models\Gender;
use App\Models\Kind;
use App\Models\Pet;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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

        view()->composer(['layouts.header'], function ($view) {
            $view->with('possibleErrors', Pet::whereDoesntHave('visits')->count());
            $view->with('currentUser', auth()->user());
            $view->with('authenticated', auth()->check());
        });

        view()->composer(['owner.forms.create', 'owner.pet.forms.add', 'pet.edit'], function ($view) {
            $view->with('genders', Gender::all());
            $view->with('kinds', Kind::all());
            $view->with('castrationConditions', CastrationCondition::all());
        });

        view()->composer(['notes.index'], function ($view) {
            $view->with('statuses', Status::all());
        });

        view()->composer(['pet.visit.forms.add', 'visit.edit'], function ($view) {
            $view->with('doctors', User::exceptRoot()->where('is_active', 1)->get());
        });

        view()->composer(['admin.users.row', 'admin.users.add', 'admin.users.index'], function ($view) {
            $view->with('currentUser', Auth::user());
        });

        view()->composer(['owner.forms.create', 'owner.pet.forms.add', 'pet.visit.forms.add', 'pet.visit.forms.search', 'pet.edit', 'visit.index'], function ($view) {
            $view->with('dateInputMaxValue', Carbon::create('today')->format('Y-m-d'));
        });
    }
}
