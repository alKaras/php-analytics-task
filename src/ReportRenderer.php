<?php

declare(strict_types=1);

namespace App;

use App\Contract\RendererInterface;
use App\DTO\ReportResult;

class ReportRenderer implements RendererInterface
{
    public function renderToConsole(ReportResult $result): void
    {
        echo "Start report" . PHP_EOL;
        echo "Valid orders: {$result->count}" . PHP_EOL;
        echo "Total paid: {$result->totalPaid}" . PHP_EOL;
        echo "Avg amount: {$result->average}" . PHP_EOL;
    }

    public function renderToFile(ReportResult $result, string $path): void
    {
        $content = implode(PHP_EOL, [
            "Valid orders: {$result->count}",
            "Total paid: {$result->totalPaid}",
            "Avg amount: {$result->average}",
        ]) . PHP_EOL;

        $handle = fopen($path, 'w');
        if ($handle === false) {
            throw new \RuntimeException("Unable to open file {$path}");
        }

        try {
            flock($handle, LOCK_EX);
            fwrite($handle, $content);
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }


}