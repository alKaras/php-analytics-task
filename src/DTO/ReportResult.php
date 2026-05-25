<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class ReportResult
{
    public function __construct(
        public int   $count,
        public float $totalPaid,
        public float $average
    ) {}
}