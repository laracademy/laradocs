<?php

namespace App\Providers;

use App\Models\Version;
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
        // lets set the versions for all of the administration views
        view()->composer('administration/*', function($view) {
            $view->with('list_versions', Version::orderBy('tag')->get());
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
