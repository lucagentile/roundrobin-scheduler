<?php

use Gautile\RoundRobin\RoundRobinScheduler;

class UtilsRoundDistributionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var RoundRobinScheduler
     */
    private $utils;

    public function setup()
    {
        $this->utils = new RoundRobinScheduler();
    }

    /**
     * @dataProvider provideValidArrayOfTeams
     * @param $input
     */
    public function testDistributeAmongRounds($input, $expected, $msg)
    {
        $numberOfRounds = 3;
        $output = $this->utils->distributeAmongRounds($input, $numberOfRounds);
        $this->assertEquals($output, $expected, $msg);
    }

    public function testInvalidTeamsArgument()
    {
        $this->expectException('InvalidArgumentException');
        $this->utils->distributeAmongRounds(null, 3);
    }

    public function testInvalidRoundsArgument()
    {
        $this->expectException('InvalidArgumentException');
        $this->utils->distributeAmongRounds(['Manchester Utd', 'Liverpool'], 'three');
    }

    public function testInputRoundsMoreThanTeams()
    {
        $this->expectException('InvalidArgumentException');
        $this->utils->distributeAmongRounds(['Manchester Utd', 'Liverpool'], 3);
    }

    public function testInputOnlyOneTeam()
    {
        $this->expectException('InvalidArgumentException');
        $this->utils->distributeAmongRounds(['Manchester Utd'], 1);
    }

    public function provideValidArrayOfTeams()
    {
        return [
            [
                ['Milan', 'Roma', 'Juventus', 'Napoli', 'Inter', 'Lazio', 'Fiorentina', 'Udinese', 'Sampdoria', 'Genoa'],
                [
                    ['Genoa', 'Fiorentina', 'Napoli', 'Milan'],
                    ['Sampdoria', 'Lazio', 'Juventus'],
                    ['Udinese', 'Inter', 'Roma']
                ],
                "Returned set of rounds from valid array of teams doesn't match the expected one"
            ],//end #1 dataset
        ];
    }//provideValidOddRound()
}