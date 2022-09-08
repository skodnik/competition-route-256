<?php

declare(strict_types=1);

$testCaseCount = readline();

for ($i = 0; $i < $testCaseCount; $i++) {
    $developersCount = readline();
    $developersGrade = explode(' ', readline());
    $developersGrade = array_combine(range(1, count($developersGrade)), $developersGrade);

    foreach ($developersGrade as $developerIndex => $developerGrade) {
        $diffs = [];

        if (!key_exists($developerIndex, $developersGrade)) {
            continue;
        }

        foreach ($developersGrade as $developerIndexSub => $developerGradeSub) {
            if ($developerIndex === $developerIndexSub) {
                continue;
            }

            $diff = abs((int)$developerGrade - (int)$developerGradeSub);
            $diffs[$developerIndexSub] = $diff;
        }

        asort($diffs);

        $desired = array_key_first($diffs);

        unset(
            $developersGrade[$developerIndex],
            $developersGrade[$desired],
        );

        echo $developerIndex . ' ' . $desired . PHP_EOL;
    }

    if ($i != $testCaseCount - 1) { // костыль для тестов
        echo PHP_EOL;
    }
}
