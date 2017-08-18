<?php

namespace Gautile\RoundRobin\Facades;

use Illuminate\Support\Facades\Facade;

class RoundRobinScheduler extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor()
    {
        return 'roundrobin-scheduler';
    }
}
