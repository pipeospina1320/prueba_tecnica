<?php

namespace App\Repositories;

use App\Http\Factory\Models\OrderTrakedFactory;
use App\Models\OrderTraked;

class OrderTrakedRepository
{
    public static function getLastPendingTransaction($orderId): ?OrderTraked
    {
        return OrderTraked::where('status', OrderTrakedFactory::PENDING)
            ->where('order_id', $orderId)->first();
    }

    public static function getLastTransaction($orderId, $codeTransaction): ?OrderTraked
    {
        return OrderTraked::where('order_id', $orderId)
            ->where('code_transaction', $codeTransaction)
            ->first();
    }
}
