<?php

$input = file_get_contents("./input.txt");

$result = 0;

foreach (explode("\n", $input) as $gameId => $line) {
    $currentSetMaxs = [
        "red" => 0,
        "blue" => 0,
        "green" => 0
    ];
    preg_match("/^(Game\s\d+\:\s)(.*)/", $line, $matches);

    $subsets = explode(";", $matches[2]);

    foreach ($subsets as $subset) {
        preg_match_all("/(\d+)(\s)(\w+)/", $subset, $colorStrings);

        $matchingByColors = array_combine($colorStrings[3], $colorStrings[1]);

        foreach ($matchingByColors as $color => $number) {
            if ($currentSetMaxs[$color] < $number) {
                $currentSetMaxs[$color] = $number;
            }
        }
    }

    $result += array_product($currentSetMaxs);
}

echo "Result: $result" . PHP_EOL;
