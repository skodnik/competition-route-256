<?php

declare(strict_types=1);

$testCaseCount = readline();

for ($i = 0; $i < $testCaseCount; $i++) {
    $goodsCount = readline();
    $total = 0;

    $goodsPrice = explode(' ', readline());

    asort($goodsPrice);

    $priceValuesCount = array_count_values($goodsPrice);

    foreach ($priceValuesCount as $price => $count) {
        $goodsInAction = (int)($count / 3);
        $remainder = $count % 3;

        $total += ($goodsInAction * $price * 2) + ($price * $remainder);
    }

    echo $total . PHP_EOL;
}
