<?php

/**
 * This method doesn't take into account the number of bills
 */

$bank = [25, 30, 50, 100,];
$sum = isset($argv[1]) ? (int)$argv[1] : 220;

function calc(int $money, array $bank): array
{
    $needBills = [];
    $minBills = [0 => 0];
    $bankLength = count($bank) - 1;

    // $minBills will contain solutions for all values from zero to $money
    for ($sum = 1; $sum <= $money; $sum++) {

        // by default the sum can't be issued
        $minBills[$sum] = INF;

        for ($i = $bankLength; $i >= 0; $i--) {
            $curBill = $bank[$i];

            if ($sum >= $curBill) {
                $billCount = $minBills[$sum - $curBill] + 1;

                if ($minBills[$sum] > $billCount) {
                    $minBills[$sum] = $billCount;
                }
            }
        }
    }

    // the sum can't be issued given bills
    if ($minBills[$money] === INF) {
        return [];
    }

    $sum = $money;
    while ($sum > 0) {
        $curSum = $sum;

        for ($i = $bankLength; $i >= 0; --$i) {
            $curBill = $bank[$i];

            if ($sum >= $curBill && ($minBills[$sum] === $minBills[$sum - $curBill] + 1)) {
                if (!isset($needBills[$i])) {
                    $needBills[$i] = 0;
                }
                ++$needBills[$i];
                $sum -= $curBill;
                break;
            }
        }

        // not enough bills
        if ($curSum === $sum) {
            $needBills = [];
            break;
        }
    }

    return $needBills;
}

$needBills = calc($sum, $bank);
$result = [];
$controlSum = 0;

if ($needBills) {
    foreach ($needBills as $i => $quantity) {
        $nominal = $bank[$i];
        $controlSum += $nominal * $quantity;
        $result[] = "{$quantity} bills of {$nominal}";
    }

    echo ($controlSum === $sum
            ? "Sum was - {$sum}. You need: " . join(', ', $result)
            : "Checksum {$controlSum} does not match c {$sum}.") . PHP_EOL;
} else {
    echo "Can't give this sum of money: {$sum}." . PHP_EOL;
}
