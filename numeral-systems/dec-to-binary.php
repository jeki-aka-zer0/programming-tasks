<?php

$decNum = isset($argv[1]) ? (int)$argv[1] : 42;

function divideBy2(string $decNum): string
{
    $remStack = new SplStack;

    while ($decNum > 0) {
        $rem = $decNum % 2;
        $remStack->push($rem);
        $decNum = floor($decNum / 2);
    }

    $binString = '';
    while (!$remStack->isEmpty()) {
        $binString .= $remStack->pop();
    }

    return $binString;
}

$binString = divideBy2($decNum);
$binNative = decbin($decNum);

echo $binString === $binNative
    ? "'{$decNum}' is '{$binString}' in decimal notation."
    : "Something went wrong, '{$binNative}' isn't equal '{$binString}'."
, PHP_EOL;
