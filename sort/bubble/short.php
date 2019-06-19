<?php

/**
 * O(n^2)
 */

$list = isset($argv[1]) ? explode(',', $argv[1]) : [20, 30, 40, 90, 50, 60, 70, 80, 100, 110];

function bubbleSort(array $list): array
{
    $counter = 0;
    $exchanges = true;
    $passNum = count($list) - 1;

    while ($passNum > 0 && $exchanges) {
        $exchanges = false;
        for ($j = 0; $j < $passNum; $j++) {
            $counter++;
            if ($list[$j] > $list[$j + 1]) {
                $exchanges = true;
                $temp = $list[$j];
                $list[$j] = $list[$j + 1];
                $list[$j + 1] = $temp;
            }
        }
    }

    return ['Number of iterations' => $counter, 'list' => join(', ', $list)];
}

print_r(bubbleSort($list));
echo PHP_EOL;
