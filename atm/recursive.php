<?php

/**
 * This method takes into account the number of bills
 */

$bank = [
    [
        'nominal' => 30,
        'quantity' => 100,
    ],
    [
        'nominal' => 50,
        'quantity' => 3,
    ],
    [
        'nominal' => 100,
        'quantity' => 2,
    ],
    [
        'nominal' => 500,
        'quantity' => 200,
    ],
];
$sum = isset($argv[1]) ? (int)$argv[1] : 220;
$result = [];

function calc(int $sum, array $bank, &$result, int $prevNominal = null): bool
{
    $bill = $billKey = false;

    // find the right bill
    for ($i = count($bank) - 1; $i >= 0; --$i) {
        $curBill = $bank[$i];

        if ($curBill['quantity'] > 0 && $curBill['nominal'] <= $sum && (null === $prevNominal || $curBill['nominal'] < $prevNominal)) {
            $bill = $curBill;
            $billKey = $i;
            $i = -1;
        }
    }

    // can't find the right bill
    if (false === $bill) {
        return false;
    }

    $quantity = floor($sum / $bill['nominal']);

    // ensure that we have enough bills
    if ($quantity > $bill['quantity']) {
        $quantity = $bill['quantity'];
    }

    // consider used bill
    $result[] = [
        'nominal' => $bill['nominal'],
        'quantity' => $quantity,
    ];
    $bank[$billKey]['quantity'] -= $quantity;

    // remaining sum of money
    $last = $sum - ($quantity * $bill['nominal']);

    if ($last > 0) {

        // try to solve in a simple way at first
        $stop = false;
        while (!$stop && !calc($last, $bank, $result, $prevNominal)) {

            // otherwise try to step back
            $found = false;
            for ($i = count($result) - 1; $i >= 0; --$i) {
                if (!$found && $result[$i]['quantity'] > 0) {

                    $prevNominal = $result[$i]['nominal'];
                    $last += $prevNominal;
                    $result[$i]['quantity']--;

                    foreach ($bank as $index => $bill) {
                        if ($bill['nominal'] === $prevNominal) {
                            $bank[$index]['quantity']++;
                            break;
                        }
                    }

                    $found = true;
                }
            }

            if (false === $found) {
                $stop = true;
            }
        }

        if ($stop) {
            return false;
        }
    }

    return true;
}

if (!calc($sum, $bank, $result)) {
    echo "Can't give this sum of money: {$sum}." . PHP_EOL;
} else {
    echo
    "Sum was - {$sum}. You need: ",
    join(', ', array_filter(array_map(function (array $item): ?string {
        return $item['quantity'] > 0
            ? "{$item['quantity']} bills of {$item['nominal']}"
            : null;
    }, $result))),
    '.',
    PHP_EOL;
}
