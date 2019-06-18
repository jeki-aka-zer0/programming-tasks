<?php

$str = isset($argv[1]) ? (string)$argv[1] : '(()(()))';

function parChecker(string $str): bool
{
    $s = new SplStack;
    $i = 0;
    $length = strlen($str);
    $balanced = $length > 0;

    while ($i < $length && $balanced) {
        $symbol = $str[$i];
        switch ($symbol) {
            case '(':
                $s->push($symbol);
                break;
            case ')':
                if ($s->isEmpty()) {
                    $balanced = false;
                } else {
                    $s->pop();
                }
                break;
            default:
                $balanced = false;
                break;
        }

        $i++;
    }

    return $balanced && $s->isEmpty();
}

echo
(parChecker($str)
    ? "Yes, string '{$str}' is balanced."
    : "No, string '{$str}' isn't balanced."
), PHP_EOL;
