<?php

/**
 * O(n log n)
 */

$list = isset($argv[1]) ? explode(',', $argv[1]) : [20, 30, 40, 90, 50, 60, 70, 80, 100/*, 110*/];

function mergeSort(array $list): array
{
    $length = count($list);

    if ($length > 1) {
        $mid = floor($length / 2);

        $left = array_slice($list, 0, $mid);
        $right = array_slice($list, $mid);

        $left = mergeSort($left);
        $right = mergeSort($right);

        $i = $j = $k = 0;
        $leftLength = count($left);
        $rightLength = count($right);

        while ($i < $leftLength && $j < $rightLength) {
            if ($left[$i] < $right[$j]) {
                $list[$k] = $left[$i];
                $i++;
            } else {
                $list[$k] = $right[$j];
                $j++;
            }
            $k++;
        }

        while ($i < $leftLength) {
            $list[$k] = $left[$i];
            $i++;
            $k++;
        }

        while ($j < $rightLength) {
            $list[$k] = $right[$j];
            $j++;
            $k++;
        }
    }

    return $list;
}

print_r(mergeSort($list));
echo PHP_EOL;
