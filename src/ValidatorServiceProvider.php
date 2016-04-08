<?php

namespace DateTimeValidator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('during', 'DateTimeValidator\DateTimeValidator@during');
        Validator::replacer('during', 'DateTimeValidator\DateTimeValidator@duringMessage');
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
