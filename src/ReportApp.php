<?php

declare(strict_types=1);

namespace App;

use App\Contract\LoggerInterface;
use App\Contract\RendererInterface;
use App\DTO\Order;
use App\DTO\ReportResult;

class ReportApp
{

    /**
     * @var Order[]
     */
    private array $orders;
    private string $file;
    private ReportResult $result;
    private LoggerInterface $logger;
    private RendererInterface $renderer;
    private ReportCalculator $calculator;

    public function __construct(array $orders, string $file)
    {
        $this->orders = array_map(
            fn(array $order) => Order::fromArray($order),
            $orders
        );
        $this->file = $file;

        $this->logger = new Logger(__DIR__ . '/../logs/app.log');
        $this->renderer = new ReportRenderer();
        $this->calculator = new ReportCalculator();

        $this->logger->info('ReportApp initialized');
    }

    public function process(): void
    {
        $this->result = $this->calculator->calculate($this->orders);
        $this->logger->info("Processed {$this->result->count} valid orders");
    }

    public function write(): void
    {
        $this->renderer->renderToFile($this->result, $this->file);
        $this->logger->info("Report written to {$this->file}");
    }

    public function summary(): void
    {
        $this->renderer->renderToConsole($this->result);
    }

    public function __destruct()
    {
        $this->logger->info('ReportApp finished');
    }
}