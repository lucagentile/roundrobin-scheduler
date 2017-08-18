<?php

namespace Gautile\RoundRobin\Tests\Integration;

use ReflectionClass;

class RoundRobinSchedulerTest extends TestCase
{
    /**
     * @var \Gautile\RoundRobin\RoundRobinSchedulerServiceProvider
     */
    private $serviceProvider;

    /**
     * @var \Gautile\RoundRobin\Facades\RoundRobinScheduler
     */
    private $facade;

    private $className = 'roundrobin-scheduler';

    public function setup()
    {
        $this->facade = new \Gautile\RoundRobin\Facades\RoundRobinScheduler();
        $this->serviceProvider = new \Gautile\RoundRobin\RoundRobinSchedulerServiceProvider($this->app);
    }

    public function testServiceNameHasntChangedAndCorrectlyProvided()
    {
        $classNames = $this->serviceProvider->provides();

        $this->assertTrue(is_array($classNames),
            'The method doesn\'t return an array of strings');

        $this->assertTrue(in_array($this->className, $classNames),
            'The ServiceProvider doesn\'t return '.$this->className);

        //check that also the facade returns the correct service name
        $facade = self::getMethod(\Gautile\RoundRobin\Facades\RoundRobinScheduler::class, 'getFacadeAccessor');
        $this->assertSame($this->className, $facade->invokeArgs($this->facade, []));
    }

    /**
     * @param $class
     * @param $name
     *
     * @return \ReflectionMethod
     *
     * @link https://stackoverflow.com/questions/249664/best-practices-to-test-protected-methods-with-phpunit#answer-2798203
     */
    protected static function getMethod($class, $name)
    {
        $class = new ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
