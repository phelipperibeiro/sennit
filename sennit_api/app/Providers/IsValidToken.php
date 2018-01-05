<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class IsValidToken extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('IsValidToken', function ($attribute, $value) {
            
            echo 'sdvsdvsdvsdvsdvs';exit;
            
            return preg_match('/^\(\d{2}\)\d{4,5}-\d{4}$/', $value) > 0;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
