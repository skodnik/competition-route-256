<?php

declare(strict_types=1);

$testCaseCount = readline();

for ($i = 0; $i < $testCaseCount; $i++) {
    $timeIntervalsCount = readline();

    $passed = true;
    $seconds = [];

    for ($intervalIterator = 0; $intervalIterator < $timeIntervalsCount; $intervalIterator++) {
        [$timeIntervalFrom, $timeIntervalTo] = explode('-', readline());

        if (!$passed) {
            continue;
        }

        try {
            $from = getSeconds($timeIntervalFrom);
            $to = getSeconds($timeIntervalTo);
        } catch (InvalidArgumentException $exception) {
            $passed = false;

            continue;
        }

        if ($from > $to || isset($seconds[$from]) || isset($seconds[$to])) {
            $passed = false;

            continue;
        }

        for ($secondIterator = $from; $secondIterator <= $to; $secondIterator++) {
            if (isset($seconds[$secondIterator])) {
                $passed = false;

                continue;
            }

            $seconds[$secondIterator] = $intervalIterator;
        }
    }

    echo $passed ? 'YES' . PHP_EOL : 'NO' . PHP_EOL;
}

function getSeconds(string $time): int
{
    [$h, $m, $s] = explode(':', $time);

    if ($h >= 0 && $h < 24 && $m >= 0 && $m < 60 && $s >= 0 && $s < 60) {
        return ((int)$h * 60 * 60) + ((int)$m * 60) + (int)$s;
    }

    throw new InvalidArgumentException('Invalid time!');
}
