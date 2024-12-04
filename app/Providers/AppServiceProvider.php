<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(['announcements.create', 'announcements.edit'], function ($view) {
            $view->with('programs', [
                'Bachelor of Performing Arts',
                'Bachelor of Public Administration',
                'Bachelor of Science in Biology',
                'Bachelor of Science in Environmental Science',
                'Bachelor of Science in Exercise Sports and Sciences',
                'Bachelor of Science in Mathematics',
                'Bachelor of Science in Social Work',
                'Liberal Arts Program'
            ]);
        });
    }
}