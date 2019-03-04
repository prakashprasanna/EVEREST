<?php

namespace App\Providers;
use App\subject;
use Illuminate\Support\ServiceProvider;

class DynamicSubject extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('subject_array', subject::all()); // array which is used to store subject data
        });

    }

}