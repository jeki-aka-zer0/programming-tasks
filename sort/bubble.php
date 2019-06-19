<?php

/**
 * O(n^2)
 */

$list = isset($argv[1]) ? explode(',', $argv[1]) : [54, 26, 93, 17, 77, 31, 44, 55, 20];

function bubbleSort(array $list): array
{
    for ($i = count($list) - 1; $i > 0; $i--) {
        for ($j = 0; $j < $i; $j++) {
            if ($list[$j] > $list[$j + 1]) {
                $temp = $list[$j];
                $list[$j] = $list[$j + 1];
                $list[$j + 1] = $temp;
            }
        }
    }

    return $list;
}

print_r(bubbleSort($list));
echo PHP_EOL;
