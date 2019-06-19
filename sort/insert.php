<?php

/**
 * O(n^2)
 */

$list = isset($argv[1]) ? explode(',', $argv[1]) : [20, 30, 40, 90, 50, 60, 70, 80, 100, 110];

function chooseSort(array $list): array
{
    $count = count($list);

    for ($i = 1, $counter = 0; $i < $count; $i++) {
        $currentValue = $list[$i];
        $position = $i;

        while ($position > 0 && $list[$position - 1] > $currentValue) {
            $counter++;
            $list[$position] = $list[$position - 1];
            $position--;
        }


        $list[$position] = $currentValue;
    }

    return ['Number of iterations' => $counter, 'list' => join(', ', $list)];
}

print_r(chooseSort($list));
echo PHP_EOL;
