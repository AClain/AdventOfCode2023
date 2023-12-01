<?php

$input = file_get_contents('./input.txt');
$result = 0;

$input = str_replace("oneight", "oneeight", $input);
$input = str_replace("twone", "twoone", $input);
$input = str_replace("threeight", "threeeight", $input);
$input = str_replace("fiveight", "fiveeight", $input);
$input = str_replace("sevenine", "sevennine", $input);
$input = str_replace("eighthree", "eightthree", $input);
$input = str_replace("eightwo", "eighttwo", $input);
$input = str_replace("nineight", "nineeight", $input);

function toInt(string|int $var): int
{
	$numberStrings = [
		"one" => 1,
		"two" => 2,
		"three" => 3,
		"four" => 4,
		"five" => 5,
		"six" => 6,
		"seven" => 7,
		"eight" => 8,
		"nine" => 9
	];

	if (!is_numeric($var)) {
		return $numberStrings[$var];
	}

	return $var;
}

foreach (explode(PHP_EOL, $input) as $index => $line) {
	preg_match_all("/(\d)|(one)|(two)|(three)|(four)|(five)|(six)|(seven)|(eight)|(nine)/", $line, $matches);

	$numbers = $matches[0];

	if (empty($numbers)) {
		continue;
	}

	if (sizeof($numbers) === 1) {
		$result += intval(strval(toInt($numbers[0])) . strval(toInt($numbers[0])));
		continue;
	}

	$result += intval(strval(toInt($numbers[0])) . strval(toInt($numbers[sizeof($numbers) - 1])));
}

echo "Result: " . strval($result) . PHP_EOL;
