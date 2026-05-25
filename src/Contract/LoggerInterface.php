<?php

declare(strict_types=1);

namespace App\Contract;

interface LoggerInterface
{
    public function info(string $message): void;

    public function warning(string $message): void;

    public function error(string $message): void;
}