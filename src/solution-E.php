<?php

declare(strict_types=1);

$stdin = fopen('php://stdin', 'r');

$count = quickReadline($stdin);

for ($i = 0; $i < $count; $i++) {
    $timeIntervalsCount = quickReadline($stdin);

    $passed = true;
    $seconds = [];

    for ($intervalIterator = 0; $intervalIterator < $timeIntervalsCount; $intervalIterator++) {
        $interval = quickReadline($stdin);

        if (!$passed) {
            continue;
        }

        [$timeIntervalFrom, $timeIntervalTo] = explode('-', $interval);

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
        return (int)$h * 3600 + (int)$m * 60 + (int)$s;
    }

    throw new InvalidArgumentException('Invalid time!');
}

function quickReadline($stdin): ?string
{
    if ($line = fgets($stdin)) {
        return rtrim($line, "\r\n");
    }

    return null;
}

fclose($stdin);
