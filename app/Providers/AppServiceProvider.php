<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CourseService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CourseService::class, function ($app) {
            return new CourseService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
