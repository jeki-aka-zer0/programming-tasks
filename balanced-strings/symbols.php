<?php

$str = isset($argv[1]) ? (string)$argv[1] : '([]{})';

define('OPENERS', '([{');
define('CLOSERS', ')]}');

function parChecker(string $str): bool
{
    $s = new SplStack;
    $i = 0;
    $length = strlen($str);
    $balanced = $length > 0;

    while ($i < $length && $balanced) {
        $symbol = $str[$i];

        if (false !== strpos(OPENERS, $symbol)) {
            $s->push($symbol);
        } elseif (false !== strpos(CLOSERS, $symbol)) {
            if ($s->isEmpty()) {
                $balanced = false;
            } else {
                $top = $s->pop();
                if (!matches($top, $symbol)) {
                    $balanced = false;
                }
            }
        } elseif ($symbol !== ' ') {
            $balanced = false;
        }

        $i++;
    }

    return $balanced && $s->isEmpty();
}

function matches(string $open, string $close): bool
{
    return strpos(OPENERS, $open) === strpos(CLOSERS, $close);
}

echo
(parChecker($str)
    ? "Yes, string '{$str}' is balanced."
    : "No, string '{$str}' isn't balanced."
), PHP_EOL;
