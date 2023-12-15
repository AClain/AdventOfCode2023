<?php

$input = explode("\n", file_get_contents("./input.txt"));

function dd(...$vars)
{
	var_dump($vars);
	exit();
}

$allHands = [
	"five" => [],
	"four" => [],
	"full" => [],
	"three" => [],
	"two" => [],
	"one" => [],
	"high" => []
];

$corresponding = [];

$result = 0;

foreach ($input as $line) {
	preg_match_all('/(\w+)/', $line, $matching);

	$inHand = $matching[0][0];
	$bet = $matching[0][1];

	$inHand = str_replace("A", "E", $inHand);
	$inHand = str_replace("K", "D", $inHand);
	$inHand = str_replace("Q", "C", $inHand);
	$inHand = str_replace("J", "B", $inHand);
	$inHand = str_replace("T", "A", $inHand);

	$corresponding[$inHand] = $bet;

	$inHandArray = str_split($inHand);

	$filteredInHandArray = array_unique($inHandArray);

	if (sizeof($filteredInHandArray) === 5) {
		array_push($allHands['high'], join("", $inHandArray));
		continue;
	} else if (sizeof($filteredInHandArray) === 4) {
		array_push($allHands['one'], join("", $inHandArray));
		continue;
	} else if (sizeof($filteredInHandArray) === 1) {
		array_push($allHands['five'], join("", $inHandArray));
		continue;
	} else if (sizeof($filteredInHandArray) === 3) {
		// Has two pairs or three same
		if (in_array(3, array_count_values($inHandArray))) {
			array_push($allHands['three'], join("", $inHandArray));
			continue;
		}

		array_push($allHands['two'], join("", $inHandArray));
	} else if (sizeof($filteredInHandArray) === 2) {
		// Has full or four same
		if (in_array(4, array_count_values($inHandArray))) {
			array_push($allHands['four'], join("", $inHandArray));
			continue;
		}

		array_push($allHands['full'], join("", $inHandArray));
		continue;
	}
}

$allHands = array_map(function ($value) {
	rsort($value, SORT_STRING);
	return $value;
}, $allHands);

$placedArray = array_reverse(
	array_merge(
		...array_values($allHands)
	)
);

foreach ($placedArray as $place => $inHand) {
	echo "place " . $place + 1 . " bet " . $corresponding[$inHand] . PHP_EOL;
	$result += (intval($place) + 1) * intval($corresponding[$inHand]);
}

echo "Result: $result" . PHP_EOL;