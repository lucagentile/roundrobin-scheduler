<?php

use Gautile\RoundRobin\RoundRobinScheduler;

class UtilsBergerAlgorithmTest extends PHPUnit_Framework_TestCase
{

    private $utils;

    /**
     * @var RoundRobinScheduler
     */
    public function setup()
    {
        $this->utils = new RoundRobinScheduler();
    }

    /**
     * @dataProvider provideValidEvenRound
     * @param $input
     * @param $expected
     * @param $msg
     */
    public function testValidEvenRound($input, $expected, $msg)
    {
        $output = $this->utils->BergerAlgorithm($input);
        $this->assertEquals($output, $expected, $msg);
    }

    /**
     * @dataProvider provideValidOddRound
     * @param $input
     * @param $expected
     * @param $msg
     */
    public function testValidOddRound($input, $expected, $msg)
    {
        $output = $this->utils->BergerAlgorithm($input);
        $this->assertEquals($output, $expected, $msg);
    }

    public function testInputOnlyTwoTeams()
    {
        $input = ['Milan', 'Inter'];
        $output = $this->utils->BergerAlgorithm($input);
        $this->assertSame($output, [['Milan','Inter']]);
    }

    public function testInputZeroTeam()
    {
        $this->expectException('InvalidArgumentException');
        $this->utils->BergerAlgorithm([]);
    }

    public function testInvalidArgument()
    {
        $this->expectException('InvalidArgumentException');
        $this->utils->BergerAlgorithm(null);
    }

    public function provideValidEvenRound()
    {
        return [
            [
                ['Juventus', 'Milan', 'Roma', 'Napoli'],
                [
                    [
                        ['Napoli', 'Juventus'], ['Roma', 'Milan']
                    ],
                    [
                        ['Juventus', 'Milan'], ['Roma', 'Napoli']
                    ],
                    [
                        ['Roma', 'Juventus'], ['Milan', 'Napoli']
                    ]
                ],
                "Provided valid even array doesn't match the expected completed round"
            ],//end #1 dataset
        ];
    }//provideValidEvenRound()

    public function provideValidOddRound()
    {
        return [
            [
                ['Juventus', 'Milan', 'Roma', 'Napoli', 'Inter'],
                [
                    [
                        ['REST', 'Juventus'], ['Inter', 'Milan'],  ['Napoli', 'Roma']
                    ],
                    [
                        ['Juventus', 'Milan'], ['Roma', 'REST'], ['Napoli', 'Inter']
                    ],
                    [
                        ['Roma', 'Juventus'], ['Milan', 'Napoli'], ['REST', 'Inter']
                    ],
                    [
                        ['Juventus', 'Napoli'], ['Inter', 'Roma'], ['REST', 'Milan']
                    ],
                    [
                        ['Inter', 'Juventus'], ['Napoli', 'REST'], ['Roma', 'Milan']
                    ]
                ],
                "Provided valid odd array doesn't match the expected completed round"
            ],//end #1 datase
            [
                ['Napoli'],
                [
                    ['Napoli', 'REST']
                ],
                "If function get only one team, it should return an array with that team and REST"
            ]
        ];
    }//provideValidOddRound()
}//testClass