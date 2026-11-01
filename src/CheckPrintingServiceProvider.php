<?php

namespace BrianZaballa\CheckPrinting;

use Illuminate\Support\ServiceProvider;

class CheckPrintingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/check-printing.php', 'check-printing');

        $this->app->singleton(CheckPrinter::class, fn ($app) => new CheckPrinter(
            $app->make('view'),
            $app['config']->get('check-printing'),
        ));
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'check-printing');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/check-printing.php' => config_path('check-printing.php'),
            ], 'check-printing-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/check-printing'),
            ], 'check-printing-views');
        }
    }
}
