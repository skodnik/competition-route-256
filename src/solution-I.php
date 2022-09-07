<?php

declare(strict_types=1);

$testCaseCount = readline();

for ($i = 0; $i < $testCaseCount; $i++) {
    $daysCount = readline();
    $tasks = explode(' ', readline());

    $continuously = true;
    $tasksValueCount = array_count_values($tasks);

    foreach ($tasks as $index => $task) {
        if (key_exists($task, $tasksValueCount)) {
            $forecastIndex = $tasksValueCount[$task] - 1 + $index;

            for ($is = $index; $is <= $forecastIndex; $is++) {
                if ($task != $tasks[$is]) {
                    $continuously = false;

                    break(2);
                }
                unset($tasksValueCount[$task]);
            }
        }
    }

    echo $continuously ? 'YES' . PHP_EOL : 'NO' . PHP_EOL;
}
