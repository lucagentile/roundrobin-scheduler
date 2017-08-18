# Round-robin scheduler
You can easily create round-robin rounds for a tournament.

Laravel ready.

There are two methods. One is **BergerAlgorithm($teams)** which takes an array of teams as argument and returns the set of matches.

Given an array of teams like:
````
['Juventus', 'Milan', 'Roma', 'Napoli', 'Inter']    
````
the method returns a multilevel array, in which the first level is the game day:
````
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
]
````
If the team count is odd, it adds a dummy team.

The other one is **distributeAmongRounds($teams, $rounds)** which takes as arguments an array of teams 
and the desired amount of rounds.
I suggest you to shuffle() your team dataset before providing it to the function.

Given an array of teams like this and '3' as a desired amount of rounds:
````
['Milan', 'Roma', 'Juventus', 'Napoli', 'Inter', 'Lazio', 'Fiorentina', 'Udinese', 'Sampdoria', 'Genoa'],
````
the method returns a multilevel array:
````
[
    ['Genoa', 'Fiorentina', 'Napoli', 'Milan'],
    ['Sampdoria', 'Lazio', 'Juventus'],
    ['Udinese', 'Inter', 'Roma']
]
````

### Installation
````
composer require lucagentile\roundrobin-scheduler
````

#### Laravel:

add the ServiceProvider class name under 'providers' in config/app.php
https://laravel.com/docs/5.4/providers#registering-providers
````
Gautile\RoundRobin\RoundRobinSchedulerServiceProvider::class
````

then add the alias under 'aliases' for the Facade
````
'RoundRobinScheduler' => Gautile\RoundRobin\Facades\RoundRobinScheduler::class,
````

### License
MIT