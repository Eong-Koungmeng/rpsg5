<?php

namespace Koungmeng\Rpsg5;

use Illuminate\Support\ServiceProvider;

class RpsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'rpsg5');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/koungmeng/rpsg5'),
        ]);
    }
}
