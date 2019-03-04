<?php

namespace App\Providers;
use App\nationality;
use Illuminate\Support\ServiceProvider;

class DynamicNationality extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('nationality_array', nationality::all()); // array which is used to store nationality data
        });

    }

}
