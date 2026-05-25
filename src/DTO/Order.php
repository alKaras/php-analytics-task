<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enum\OrderStatus;

final readonly class Order
{
    public function __construct(
        public int $id,
        public string $name,
        public float $amount,
        public OrderStatus $status
    ) {}

    public static function fromArray(array $dataRow): self
    {
        return new self(
            id: $dataRow['id'],
            name: $dataRow['user'],
            amount: $dataRow['amount'],
            status: OrderStatus::from($dataRow['status'])
        );
    }
}