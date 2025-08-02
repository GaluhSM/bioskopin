<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::componentNamespace('App\\View\\Components\\Admin', 'admin');
        Blade::componentNamespace('App\\View\\Components\\Auth', 'auth');
        Blade::componentNamespace('App\\View\\Components\\Booking', 'booking');
    }
}