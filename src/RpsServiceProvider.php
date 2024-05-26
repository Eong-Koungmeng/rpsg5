<?php

namespace Koungmeng\Rpsg5;

use Illuminate\Support\ServiceProvider;

class RpsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/stubs' => base_path('/')
        ], 'Rpsg5');
    }
}
