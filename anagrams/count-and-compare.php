<?php

/**
 * O(n)
 */

define('CHARS_IN_ALPHABET', 26);

$str1 = isset($argv[1]) ? (string)$argv[1] : 'heart';
$str2 = isset($argv[2]) ? (string)$argv[2] : 'earth';

function isAnagram(string $str1, string $str2): bool
{
    $c1 = countChars($str1);
    $c2 = countChars($str2);
    $i = 0;
    $stillOk = true;

    while ($i < CHARS_IN_ALPHABET && $stillOk) {
        if ($c1[$i] === $c2[$i]) {
            $i++;
        } else {
            $stillOk = false;
        }
    }

    return $stillOk;
}

function countChars(string $str): array
{
    $counter = [];
    $counter = array_pad($counter, CHARS_IN_ALPHABET, 0);
    $firstCharOrd = ord('a');

    for ($i = 0, $cnt = strlen($str) - 1; $i <= $cnt; $i++) {
        $pos = ord($str[$i]) - $firstCharOrd;
        $counter[$pos]++;
    }

    return $counter;
}

echo isAnagram($str1, $str2)
    ? "Yes, '{$str1}' is an anagram for '{$str2}'."
    : "No, '{$str1}' isn't an anagram for '{$str2}'.'",
PHP_EOL;
