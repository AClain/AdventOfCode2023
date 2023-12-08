<?php

$input = explode("\n", file_get_contents('./input.txt'));

$seeds = [];
$wasModified = [];

foreach ($input as $y => $line) {
	if (str_contains($line, "seeds:")) {
		preg_match_all('/(\d+)(\s){0,1}/', $line, $matching);
		$seeds = array_map(function ($value) {
			return intval($value);
		}, $matching[1]);
		continue;
	}

	preg_match_all('/(\d+)(\s){0,1}/', $line, $matchingNumbers);

	if (!empty($matchingNumbers[1])) {
		$destinationStarting = intval($matchingNumbers[1][0]);
		$sourceStarting = intval($matchingNumbers[1][1]);
		$rangeLength = intval($matchingNumbers[1][2]) - 1;

		$diff = $sourceStarting - $destinationStarting;

		foreach ($seeds as $i => $seed) {
			if ($seed >= $sourceStarting && $seed <= ($sourceStarting + $rangeLength) && !in_array($i, $wasModified)) {
				$seeds[$i] = $seed - $diff;
				$wasModified[] += $i;
			}
		}
	} else {
		$wasModified = [];
	}
}

echo "Result: " . min($seeds) . PHP_EOL;
