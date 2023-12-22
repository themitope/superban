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
    }

    /**
     * Register the application service
     */
    public function register()
    {
    }
}
