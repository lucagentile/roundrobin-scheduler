<?php

namespace Gautile\RoundRobin;

use Illuminate\Support\ServiceProvider;

class RoundRobinSchedulerServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('roundrobin-scheduler', function ($app){
            return new RoundRobinScheduler();
        });
    }

    public function provides()
    {
        return [
            'roundrobin-scheduler'
        ];
    }
}