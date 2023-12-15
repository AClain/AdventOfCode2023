<?php

function dd(...$vars)
{
	var_dump($vars);
	exit();
}

$input = explode("\n", file_get_contents('./input.txt'));

$directions = array_shift($input);
array_shift($input);

class Struct
{
	public function __construct(
		public string $name,
		public string $left,
		public string $right
	) {
	}
}

$corresponding = [];

foreach ($input as $line) {
	preg_match_all('/(\w+)\s={1}\s\((\w+),{1}\s(\w+)/', $line, $matching);

	$structName = $matching[1][0];
	$left = $matching[2][0];
	$right = $matching[3][0];

	$$structName = new Struct($structName, $left, $right);

	$corresponding[$structName] = $$structName;

	if ($structName === "AAA") {
		$currentStruct = $$structName;
	}
}

$maxIteration = 50;
$currentIteration = 0;
$steps = 1;

while (true) {
	foreach (str_split($directions) as $direction) {
		$nextStruct = $corresponding[$currentStruct->right];

		if ($direction === "L") {
			$nextStruct = $corresponding[$currentStruct->left];
		}

		if ($nextStruct->name === "ZZZ") {
			echo "Found after $steps step(s)" . PHP_EOL;
			break 2;
		}

		$steps++;
		$currentStruct = $nextStruct;
	}

	$currentIteration++;
}

echo "Result: $steps" . PHP_EOL;
