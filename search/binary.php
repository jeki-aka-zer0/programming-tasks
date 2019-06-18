<?php

$search = isset($argv[1]) ? (int)$argv[1] : 32;
$list = isset($argv[2]) ? explode(',', $argv[2]) : [0, 1, 2, 8, 13, 17, 19, 32, 42];
sort($list, SORT_NUMERIC);

function search(int $search, array $list): bool
{
    $count = count($list);

    if ($count === 0) {
        return false;
    }

    $midPoint = (int)floor($count / 2);
    if ($list[$midPoint] == $search) {
        return true;
    }

    return search(
        $search,
        $search < $list[$midPoint]
            ? array_slice($list, 0, $midPoint)
            : array_slice($list, $midPoint + 1)
    );
}

echo search($search, $list) ? "Yes, '{$search}' in a list." : "No, '{$search}' isn't in a list.", PHP_EOL;
