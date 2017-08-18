<?php

namespace Gautile\RoundRobin\Tests\Integration;

use Gautile\RoundRobin\RoundRobinScheduler;
use Gautile\RoundRobin\RoundRobinSchedulerServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return \Gautile\RoundRobin\RoundRobinSchedulerServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [RoundRobinSchedulerServiceProvider::class];
    }

    /**
     * Load package alias.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'RoundRobinScheduler' => RoundRobinScheduler::class,
        ];
    }
}
