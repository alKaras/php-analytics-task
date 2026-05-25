<?php

declare(strict_types=1);

namespace App;

use App\Contract\LoggerInterface;
use App\Enum\LogLevel;

class Logger implements LoggerInterface
{
    private string $logFile;

    public function __construct(string $logFile) {
        $this->logFile = $logFile;
    }


    private function write(LogLevel $level, string $message): void
    {
        $line = \sprintf(
            "[%s] [%s] %s\n",
            date('Y-m-d H:i:s'),
            $level->value,
            $message,
        );

        file_put_contents($this->logFile, $line, FILE_APPEND | LOCK_EX);

    }

    public function info(string $message): void
    {
        $this->write(LogLevel::Info, $message);
    }

    public function warning(string $message): void
    {
        $this->write(LogLevel::Warning, $message);
    }

    public function error(string $message): void
    {
        $this->write(LogLevel::Error, $message);
    }
}