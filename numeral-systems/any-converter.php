<?php

$decNum = isset($argv[1]) ? (int)$argv[1] : 52;
$base = isset($argv[2]) ? (int)$argv[2] : 16;

function convert(string $decNum, int $base): string
{
    $digits = '0123456789ABCDEF';
    $remStack = new SplStack;

    while ($decNum > 0) {
        $rem = $decNum % $base;
        $remStack->push($rem);
        $decNum = floor($decNum / $base);
    }

    $newString = '';
    while (!$remStack->isEmpty()) {
        $newString .= $digits[$remStack->pop()];
    }

    return $newString;
}

$newString = convert($decNum, $base);

echo "'{$decNum}' is '{$newString}' in '{$base}' notation.", PHP_EOL;
