<?php

declare(strict_types=1);

$stdin = fopen('php://stdin', 'r');

$testCaseCount = quickReadline($stdin);

for ($i = 0; $i < $testCaseCount; $i++) {
    [$a, $b] = explode(' ', quickReadline($stdin));
    echo ((int)$a + (int)$b) . PHP_EOL;
}

function quickReadline($stdin): ?string
{
    if ($line = fgets($stdin)) {
        return rtrim($line, "\r\n");
    }

    return null;
}

fclose($stdin);
