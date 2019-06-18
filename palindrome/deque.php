<?php

$str = isset($argv[1]) ? (string)$argv[1] : 'radar';

function check(string $str): bool
{
    $deque = str_split($str);
    $stillEqual = true;

    while (count($deque) > 1 && $stillEqual) {
        $first = array_shift($deque);
        $last = array_pop($deque);

        if ($first !== $last) {
            $stillEqual = false;
        }
    }

    return $stillEqual;
}

echo check($str) ? "Yes, '{$str}' is a palindrome." : "No, '{$str}' isn't a palindrome.", PHP_EOL;
