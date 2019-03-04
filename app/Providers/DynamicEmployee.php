<?php

namespace App\Providers;
use App\employee;
use Illuminate\Support\ServiceProvider;

class Dynamicemployee extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('employee_array', employee::all()); // array which is used to store AJV employee data
        });

    }

}