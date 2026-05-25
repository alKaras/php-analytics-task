<?php

declare(strict_types=1);

namespace App\Contract;

use App\DTO\ReportResult;

interface RendererInterface
{
    public function renderToConsole(ReportResult $result): void;

    public function renderToFile(ReportResult $result, string $path): void;
}