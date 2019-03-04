<?php

namespace App\Providers;
use App\source;
use Illuminate\Support\ServiceProvider;

class DynamicSource extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('source_array', source::all()); // array which is used to store source data
        });

    }

}