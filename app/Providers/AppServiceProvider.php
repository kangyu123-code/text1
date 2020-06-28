<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
          // Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
          //   $reg1='/^+86-1[3-9]\d{9}$/';
          //   $reg2='/^1[3-9]\d{9}$/';
          //   return preg_match($reg1,$value)||preg_match($reg2,$value);
        
    }
}
