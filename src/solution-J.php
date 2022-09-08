<?php

declare(strict_types=1);

$testCaseCount = readline();

for ($i = 0; $i < $testCaseCount; $i++) {
    $timeIntervalsCount = readline();

    $passed = true;
    $intervals = [];

    for ($i1 = 0; $i1 < $timeIntervalsCount; $i1++) {
        [$timeIntervalFrom, $timeIntervalTo] = explode('-', readline());

        if (!$passed) {
            continue;
        }

        try {
            $from = getDateTime($timeIntervalFrom);
            $to = getDateTime($timeIntervalTo);
        } catch (InvalidArgumentException $exception) {
            $passed = false;

            continue;
        }

        if ($from > $to) {
            $passed = false;

            continue;
        }

        $intervals[$i1] = [
            'from' => $from->getTimestamp(),
            'to' => $to->getTimestamp(),
        ];
    }

    if ($passed) {
        $intervalsCount = count($intervals);

        foreach ($intervals as $index => $interval) {
            if ($index < $intervalsCount) {
                for ($i2 = $index + 1; $i2 < $intervalsCount; $i2++) {
                    $matchesFrom = $interval['from'] == $intervals[$i2]['from'];
                    $matchesTo = $interval['to'] == $intervals[$i2]['to'];

                    $fromInIntervalOut =
                        $interval['from'] >= $intervals[$i2]['from'] &&
                        $interval['from'] <= $intervals[$i2]['to'];

                    $toInIntervalOut =
                        $interval['to'] <= $intervals[$i2]['to'] &&
                        $interval['to'] >= $intervals[$i2]['from'];

                    $fromInIntervalIn =
                        $intervals[$i2]['from'] >= $interval['from'] &&
                        $intervals[$i2]['from'] <= $interval['to'] ;

                    $toInIntervalIn =
                        $intervals[$i2]['to'] <= $interval['to'] &&
                        $intervals[$i2]['to'] >= $interval['from'] ;

                    if (
                        $matchesFrom ||
                        $matchesTo ||
                        $fromInIntervalIn ||
                        $toInIntervalIn ||
                        $fromInIntervalOut ||
                        $toInIntervalOut
                    ) {
                        $passed = false;

                        break;
                    }
                }
            }
        }
    }

    echo $passed ? 'YES' . PHP_EOL : 'NO' . PHP_EOL;
}

function getDateTime(string $time): DateTimeImmutable
{
    $dateTime = DateTimeImmutable::createFromFormat(
        'Y.m.d H:i:s',
        '1970.01.01 ' . $time
    );

    if ($time !== $dateTime->format('H:i:s')) {
        throw new InvalidArgumentException('Invalid time!');
    }

    return $dateTime;
}
