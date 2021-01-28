<?php

namespace App\Providers;

use App\Platforms\MailjetPlatform;
use App\Platforms\SendGridPlatform;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MailjetPlatform::class, function () {
            return new MailjetPlatform();
        });

        $this->app->singleton(SendGridPlatform::class, function () {
            return new SendGridPlatform();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
