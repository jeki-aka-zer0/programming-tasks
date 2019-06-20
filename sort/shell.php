<?php

/**
 * O(n) or O(n^2)
 */

$list = isset($argv[1]) ? explode(',', $argv[1]) : [20, 30, 40, 90, 50, 60, 70, 80, 100, 110];

function shellSort(array $list): array
{
    $counter = 0;
    $subListCount = floor(count($list) / 2);

    while ($subListCount > 0) {
        for ($startPosition = 0; $startPosition < $subListCount; $startPosition++) {
            $list = gapInsertionSort($list, $startPosition, $subListCount, $counter);
        }

        $subListCount = floor($subListCount / 2);
    }

    return ['Number of iterations' => $counter, 'list' => join(', ', $list)];
}

function gapInsertionSort(array $list, int $start, int $gap, int &$counter): array
{
    for ($i = $start + $gap, $cnt = count($list); $i < $cnt; $i += ($gap ? $gap : 1)) {
        $currentValue = $list[$i];
        $position = $i;

        while ($position >= $gap && $list[$position - $gap] > $currentValue) {
            $list[$position] = $list[$position - $gap];
            $position -= $gap;
            $counter++;
        }

        $list[$position] = $currentValue;
    }

    return $list;
}

print_r(shellSort($list));
echo PHP_EOL;
