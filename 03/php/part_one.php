<?php

$input = explode("\n", file_get_contents('./input.txt'));

$array = [];

foreach ($input as $row => $line) {
	$array[$row] = str_split($line);
}

$specialChars = [
	'*',
	'#',
	'/',
	'=',
	'$',
	'%',
	'@',
	'&',
	'-',
	'+'
];

$result = 0;

function hasSpecialCharAround(string $x, string $y): bool
{
	if (isset($GLOBALS['array'][$x][$y - 1]) && in_array($GLOBALS['array'][$x][$y - 1], $GLOBALS['specialChars'])) {
		return true;
	} else if (isset($GLOBALS['array'][$x - 1][$y - 1]) && in_array($GLOBALS['array'][$x - 1][$y - 1], $GLOBALS['specialChars'])) {
		return true;
	} else if (isset($GLOBALS['array'][$x - 1][$y]) && in_array($GLOBALS['array'][$x - 1][$y], $GLOBALS['specialChars'])) {
		return true;
	} else if (isset($GLOBALS['array'][$x - 1][$y + 1]) && in_array($GLOBALS['array'][$x - 1][$y + 1], $GLOBALS['specialChars'])) {
		return true;
	} else if (isset($GLOBALS['array'][$x][$y + 1]) && in_array($GLOBALS['array'][$x][$y + 1], $GLOBALS['specialChars'])) {
		return true;
	} else if (isset($GLOBALS['array'][$x + 1][$y + 1]) && in_array($GLOBALS['array'][$x + 1][$y + 1], $GLOBALS['specialChars'])) {
		return true;
	} else if (isset($GLOBALS['array'][$x + 1][$y]) && in_array($GLOBALS['array'][$x + 1][$y], $GLOBALS['specialChars'])) {
		return true;
	} else if (isset($GLOBALS['array'][$x + 1][$y - 1]) && in_array($GLOBALS['array'][$x + 1][$y - 1], $GLOBALS['specialChars'])) {
		return true;
	}

	return false;
}

foreach ($array as $x => $column) {
	$buildingNumber = false;
	$shouldCount = false;
	$number = '';
	foreach ($column as $y => $row) {
		$currentValue = $array[$x][$y];

		if (!is_numeric($currentValue)) {
			if ($buildingNumber && $shouldCount) {
				$result += intval($number);
			}
			$buildingNumber = false;
			$shouldCount = false;
			$number = '';
			continue;
		}

		if (is_numeric($currentValue)) {
			$number .= $currentValue;
			$buildingNumber = true;
			$position = "$x,$y";

			if (hasSpecialCharAround($x, $y)) {
				$shouldCount = true;
			}
		}

		if (!isset($array[$x][$y + 1])) {
			if ($buildingNumber && $shouldCount) {
				$result += intval($number);
			}
		}
	}
}

echo "Result: $result" . PHP_EOL;
