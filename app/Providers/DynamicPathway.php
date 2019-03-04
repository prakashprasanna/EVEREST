<?php

namespace App\Providers;
use App\pathway;
use Illuminate\Support\ServiceProvider;

class DynamicPathway extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('pathway_array', pathway::all()); // array which is used to store AJV pathway data
        });

    }

}