<?php

$search = isset($argv[1]) ? (string)$argv[1] : '1024954';
$list = isset($argv[2]) ? explode(',', $argv[2]) : ['0272243', '5835833', '5482350', '1024954', '8934883'];
sort($list);

function search(string $search, array $list): bool
{
    $map = [];
    $length = count($list);
    foreach ($list as $item) {
        $hash = hashMap($item, $length);
        if (!isset($map[$hash])) {
            $map[$hash] = [];
        }
        $map[$hash][] = $item;
    }

    $hash = hashMap($search, $length);

    return isset($map[$hash])
        ? binarySearch($search, $map[$hash])
        : false;
}

function hashMap(string $item, int $mapLength): int
{
    $length = strlen($item);
    $sum = 0;

    for ($i = 0; $i <= $length; $i += 2) {
        $sum += (int)($item[$i] . ($item[$i + 1] ?? ''));
    }

    return $sum % $mapLength;
}

function binarySearch(string $search, array $list): bool
{
    $count = count($list);

    if ($count === 0) {
        return false;
    }

    $midPoint = (int)floor($count / 2);
    if ($list[$midPoint] == $search) {
        return true;
    }

    return binarySearch(
        $search,
        $search < $list[$midPoint]
            ? array_slice($list, 0, $midPoint)
            : array_slice($list, $midPoint + 1)
    );
}

echo search($search, $list) ? "Yes, '{$search}' in a list." : "No, '{$search}' isn't in a list.", PHP_EOL;
