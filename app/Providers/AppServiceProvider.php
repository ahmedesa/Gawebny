<?php

namespace App\Providers;

use App\Category;
use App\SiteSetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $setting = SiteSetting::getAllSettings();
        view()->share('setting', $setting);
        view()->composer(['Gawebny.home.askmodel','Gawebny.home.home','Gawebny.category.category'], function($view) {
                $view->with('categories', Category::all());
            });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
