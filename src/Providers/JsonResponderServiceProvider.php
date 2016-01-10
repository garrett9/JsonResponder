<?php

namespace DFSAInc\JsonResponder\Providers;

use Illuminate\Support\ServiceProvider;
use DFSAInc\JsonResponder\JsonResponder;

class JsonResponderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\DFSAInc\JsonResponder\JsonResponder::class, function($app) {
            return new JsonResponder($app->make(\Illuminate\Contracts\Routing\ResponseFactory::class)); 
        });
    }
}
