<?php

$search = isset($argv[1]) ? (int)$argv[1] : 13;
$list = isset($argv[2]) ? explode(',', $argv[2]) : [0, 1, 2, 8, 13, 17, 19, 32, 42];
sort($list, SORT_NUMERIC);

function search(int $search, array $list): bool
{
    $pos = 0;
    $found = $stop = false;
    $length = count($list);

    while ($pos < $length && !$found && !$stop) {
        if ($list[$pos] == $search) {
            $found = true;
        } else {
            if ($list[$pos] > $search) {
                $stop = true;
            } else {
                $pos++;
            }
        }
    }

    return $found;
}

echo search($search, $list) ? "Yes, '{$search}' in a list." : "No, '{$search}' isn't in a list.", PHP_EOL;
