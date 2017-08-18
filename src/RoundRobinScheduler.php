<?php

namespace Gautile\RoundRobin;

class RoundRobinScheduler
{

    /**
     * @link https://it.wikipedia.org/wiki/Algoritmo_di_Berger#PHP
     *
     * @param array $teamsInRound contains the teams participating
     * @return array of matches distributed by game day
     */
    public function BergerAlgorithm($teamsInRound)
    {
        if ( !is_array($teamsInRound) ) {
            throw new \InvalidArgumentException('BergerAlgorithm expects an array of teams');
        }

        $teamsCount = count($teamsInRound);

        if ($teamsCount === 0) {
            throw new \InvalidArgumentException('BergerAlgorithm expects an array of at least 1 team');
        }

        // if odd, add a dummy team
        if ($teamsCount % 2 == 1) {
            $teamsInRound[] = "REST";
            $teamsCount++;
        }

        //if just 2 teams, skip the whole process
        if (!($teamsCount > 2)) {
            return [
                [ $teamsInRound[0], $teamsInRound[1] ]
            ];
        }

        $gamesCount = $teamsCount - 1;

        $home = [];
        $away = [];

        for ($i = 0; $i < $teamsCount /2; $i++)
        {
            $home[$i] = $teamsInRound[$i];
            $away[$i] = $teamsInRound[$teamsCount - 1 - $i];
        }

        $calendar = [];
        for ($i = 0; $i < $gamesCount; $i++) {

            if (($i % 2) == 0) {
                for ($j = 0; $j < $teamsCount / 2; $j++) {
                   $calendar[$i][] = [$away[$j], $home[$j]];
                }
            } else {
                for ($j = 0; $j < $teamsCount / 2; $j++) {
                    $calendar[$i][] = [$home[$j], $away[$j]];
                }
            }

            $pivot = $home[0];
            array_unshift($away, $home[1]);
            $carryover = array_pop($away);
            array_shift($home);
            array_push($home, $carryover);
            $home[0] = $pivot;
        }//endfor

        return $calendar;
    }//end function bergerAlgorithm

    /**
     * @param array $teams teams to be distributed
     * @param int $numberOfRounds in how many rounds the teams should be distributed
     * @return array of rounds containing teams
     */
    public function distributeAmongRounds($teams, $numberOfRounds)
    {
        if ( !is_array($teams) ) {
            throw new \InvalidArgumentException('DistributeAmongRounds expects an array of teams as 1st argument');
        }

        if ( !is_numeric($numberOfRounds) ) {
            throw new \InvalidArgumentException('DistributeAmongRounds expects an integer as 2nd argument');
        }

        $teamsCount = count($teams);

        if ( $teamsCount < 2 ) {
            throw new \InvalidArgumentException('BergerAlgorithm expects an array of at least 2 teams');
        }

        if ( $numberOfRounds > $teamsCount ) {
            throw new \InvalidArgumentException('DistributeAmongRounds expects number of rounds to be more than the actual number of teams to distribute');
        }

        $rounds = [];

        while( ! empty($teams) ) {
            for( $i = 0; $i<$numberOfRounds; $i++ ) {
                if ( ! empty($teams) ) {
                    $team = array_pop($teams);
                    $rounds[$i][] = $team;
                }
                else { break; };
            }
        }
        return $rounds;
    }
}//end class