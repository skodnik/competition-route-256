<?php

declare(strict_types=1);

$stdin = fopen('php://stdin', 'r');

$testCaseCount = quickReadline($stdin);

for ($i = 0; $i < $testCaseCount; $i++) {
    $goodsCount = quickReadline($stdin);
    $total = 0;

    $goodsPrice = explode(' ', quickReadline($stdin));

    asort($goodsPrice);

    $priceValuesCount = array_count_values($goodsPrice);

    foreach ($priceValuesCount as $price => $count) {
        $goodsInAction = (int)($count / 3);
        $remainder = $count % 3;

        $total += ($goodsInAction * $price * 2) + ($price * $remainder);
    }

    echo $total . PHP_EOL;
}

function quickReadline($stdin): ?string
{
    if ($line = fgets($stdin)) {
        return rtrim($line, "\r\n");
    }

    return null;
}

fclose($stdin);
