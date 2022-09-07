<?php

declare(strict_types=1);

$testCaseCount = readline();

for ($i = 0; $i < $testCaseCount; $i++) {
    [$a, $b] = explode(' ', readline());
    echo ((int)$a + (int)$b) . PHP_EOL;
}
