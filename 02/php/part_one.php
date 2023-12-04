<?php

$input = file_get_contents("./input.txt");

$maximumMatching = [
    "red" => 12,
    "green" => 13,
    "blue" => 14
];

$result = 0;

foreach (explode("\n", $input) as $gameId => $line) {
    $isInvalid = false;
    preg_match("/^(Game\s\d+\:\s)(.*)/", $line, $matches);

    $subsets = explode(";", $matches[2]);

    foreach ($subsets as $subset) {
        preg_match_all("/(\d+)(\s)(\w+)/", $subset, $colorStrings);

        $matchingByColors = array_combine($colorStrings[3], $colorStrings[1]);

        foreach ($matchingByColors as $color => $number) {
            if ($number > $maximumMatching[$color]) {
                $isInvalid = true;
                break 2;
            }
        }
    }

    if (!$isInvalid) {
        $result += $gameId + 1;
    }
}

echo "Result: $result" . PHP_EOL;
