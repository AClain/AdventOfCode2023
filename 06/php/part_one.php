<?php

function dd(...$vars)
{
	var_dump($vars);
	exit();
}

$input = explode("\n", file_get_contents("./input.txt"));

$result = 1;

preg_match_all('/(\d+)/', $input[0], $times);
preg_match_all('/(\d+)/', $input[1], $distances);

foreach ($times[0] as $key => $time) {
	$possibleBeatableHoldingTimes = [];

	for ($holdingTime = 0; $holdingTime < intval($time); $holdingTime++) {
		$distanceToBeat = intval($distances[0][$key]);


		$maxPossibleDistance = ($time - $holdingTime) * $holdingTime;

		if ($maxPossibleDistance > $distances[0][$key]) {
			$possibleBeatableHoldingTimes[] += $time;
		}
	}

	$result = $result * sizeof($possibleBeatableHoldingTimes);
}

echo "Result: $result" . PHP_EOL;
