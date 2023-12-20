<?php

namespace Themitope\Superban;

use Illuminate\Support\ServiceProvider;
use Themitope\Superban\Middleware\SuperBanMiddleware;

class SuperBanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application service
     * @return void
     */
    public function boot()
    {
        // Register middleware
        $this->app['router']->aliasMiddleware('superban', SuperBanMiddleware::class);

        $this->publishes([
            __DIR__.'/config/superban.php' => config_path('superban.php'),
        ], 'superban');
    }

    /**
     * Register the application service
     */
    public function register()
    {
        // Merge default config from the package
        $this->mergeConfigFrom(
            __DIR__.'/config/superban.php', 'superban'
        );
    }
}
