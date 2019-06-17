<?php

/**
 * O(n^2)
 */

$str1 = isset($argv[1]) ? (string)$argv[1] : 'heart';
$str2 = isset($argv[2]) ? (string)$argv[2] : 'earth';

function isAnagram(string $str1, string $str2): bool
{
    $pos1 = 0;
    $len1 = strlen($str1);
    $len2 = strlen($str2);
    $stillOK = true;

    while ($pos1 < $len1 && $stillOK) {
        $pos2 = 0;
        $found = false;

        while ($pos2 < $len2 && !$found) {
            if (isset($str2[$pos2]) && $str1[$pos1] === $str2[$pos2]) {
                $found = true;
            } else {
                $pos2++;
            }
        }

        if ($found) {
            $str2 = substr_replace($str2, '', $pos2, 1);
        } else {
            $stillOK = false;
        }

        $pos1++;
    }

    return $stillOK && $str2 === '';
}

echo isAnagram($str1, $str2)
    ? "Yes, '{$str1}' is an anagram for '{$str2}'."
    : "No, '{$str1}' isn't an anagram for '{$str2}'.'",
PHP_EOL;
