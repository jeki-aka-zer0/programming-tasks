<?php

/**
 * O(n^2) or O(n log n)
 */

$str1 = isset($argv[1]) ? (string)$argv[1] : 'heart';
$str2 = isset($argv[2]) ? (string)$argv[2] : 'earth';

function isAnagram(string $str1, string $str2): bool
{
    $chunks1 = str_split($str1);
    sort($chunks1);
    $chunks2 = str_split($str2);
    sort($chunks2);

    return $chunks1 === $chunks2;
}

echo isAnagram($str1, $str2)
    ? "Yes, '{$str1}' is an anagram for '{$str2}'."
    : "No, '{$str1}' isn't an anagram for '{$str2}'.'",
PHP_EOL;
