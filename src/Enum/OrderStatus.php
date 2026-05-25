<?php

declare(strict_types=1);

namespace App\Enum;

enum OrderStatus: string
{
    case Paid = 'paid';
    case Pending = 'pending';
    case Cancelled = 'cancelled';
}