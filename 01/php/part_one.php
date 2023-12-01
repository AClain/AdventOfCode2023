<?php

$input = file_get_contents('./input.txt');
$result = 0;

foreach (explode(PHP_EOL, $input) as $line) {
	preg_match_all("/\d/", $line, $matches);

	$numbers = $matches[0];

	if (empty($numbers)) {
		continue;
	}

	if (sizeof($numbers) === 1) {
		$result += intval(strval($numbers[0]) . strval($numbers[0]));
		continue;
	}

	$result += intval(strval($numbers[0]) . strval($numbers[sizeof($numbers) - 1]));
}

echo "Result: " . strval($result) . PHP_EOL;
