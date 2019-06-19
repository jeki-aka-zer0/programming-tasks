<?php

/**
 * O(n^2)
 */

$list = isset($argv[1]) ? explode(',', $argv[1]) : [20, 30, 40, 90, 50, 60, 70, 80, 100, 110];

function chooseSort(array $list): array
{
    $counter = 0;

    for ($i = count($list) - 1; $i > 0; $i--) {
        $positionOfMax = 0;
        for ($j = 1; $j <= $i; $j++, $counter++) {
            if ($list[$j] > $list[$positionOfMax]) {
                $positionOfMax = $j;
            }
        }

        $temp = $list[$i];
        $list[$i] = $list[$positionOfMax];
        $list[$positionOfMax] = $temp;
    }

    return ['Number of iterations' => $counter, 'list' => join(', ', $list)];
}

print_r(chooseSort($list));
echo PHP_EOL;
