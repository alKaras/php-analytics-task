<?php

declare(strict_types=1);

namespace App;

use App\DTO\Order;
use App\DTO\ReportResult;
use App\Enum\OrderStatus;

class ReportCalculator
{

    /**
     * @param Order[] $orders
     */
    public function calculate(array $orders): ReportResult
    {
        $validOrders = array_filter(
            $orders,
            fn(Order $order) => $order->status === OrderStatus::Paid && $order->amount > 0
        );

        $count = count($validOrders);
        $total = 0;
        foreach ($validOrders as $order) {
            $total += $order->amount;
        }

        $avg = $count > 0 ? $total / $count : 0;

        return new ReportResult(
            count: $count,
            totalPaid: $total,
            average: round($avg, 2),
        );
    }
}