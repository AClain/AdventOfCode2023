<?php

$input = explode("\n", str_replace("  ", " ", file_get_contents('./input.txt')));

$result = 0;

foreach ($input as $line) {
	preg_match_all('/((\d+)(\s){0,1}){1,}(|){1}((\d+)(\s){0,1})/', $line, $matchingArrays);

	$winningList = explode(" ", trim($matchingArrays[0][0]));
	$inHandList = explode(" ", trim($matchingArrays[0][1]));

	$winningNumbers = [];
	$alreadyCounted = [];

	foreach ($inHandList as $number) {
		if (in_array($number, $winningList) && !in_array($number, $alreadyCounted)) {
			$alreadyCounted[] += $number;
			$winningNumbers[] += $number;
		}
	}

	if (!empty($winningNumbers)) {
		$result += pow(2, sizeof($winningNumbers) - 1);
	}
}

echo "Result: $result" . PHP_EOL;