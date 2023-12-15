<?php

function dd(...$vars)
{
	var_dump($vars);
	exit();
}

$input = explode("\n", file_get_contents('./input.txt'));

$result = 0;

foreach ($input as $line) {
	preg_match_all('/(\d+)/', $line, $matching);

	$startingNumbers = $matching[0];
	$depth = 0;
	$diffenrences = [];

	foreach ($startingNumbers as $i => $currentNumber) {
		if (isset($startingNumbers[$i + 1])) {
			$diffenrences[0][] = $startingNumbers[$i + 1] - $currentNumber;
		}
	}

	if (sizeof(array_unique($diffenrences[$depth])) === 1) {
		$diffenrences[$depth + 1] = array_fill(0, sizeof($diffenrences[$depth]) - 1, 0);
	}

	$depth++;

	print_r($diffenrences);
}

echo "Result: $result" . PHP_EOL;
