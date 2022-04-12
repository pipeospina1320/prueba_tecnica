<?php

namespace App\Services\OrderTraked;

use App\Http\Factory\Models\OrderFactory;
use App\Http\Factory\Models\OrderTrakedFactory;
use App\Models\Order;
use App\Repositories\OrderTrakedRepository;
use App\Services\ClientTransactionOrigins\ClientTransactionResponse;

class OrderTrakedService
{
    public static function store(Order $order, ClientTransactionResponse $resp)
    {
        $orderPending = OrderTrakedRepository::getLastTransaction($order->id, $resp->getTransactionId());
        // Rechazamos la transaccion existente
        if ($orderPending) {
            $orderPending->status = OrderTrakedFactory::REJECTED;
            $orderPending->save();
        }

        $data = [
            'order_id' => $order->id,
            'code_transaction' => $resp->getTransactionId()
        ];

        $orderTraked = OrderTrakedFactory::init($data);
        $orderTraked->save();

        // actualizamos el codigo de la transaccion a la orden
        $order->code_transaction = $resp->getTransactionId();
        $order->save();
    }

    public static function update(Order $order, ClientTransactionResponse $resp)
    {
        $orderPending = OrderTrakedRepository::getLastPendingTransaction($order->id);
        if ($orderPending) {
            $statusTransaction = $resp->getTransactionStatus();
            $statusTraked = OrderTrakedFactory::REJECTED;
            $statusOrder = OrderTrakedFactory::REJECTED;
            if ($statusTransaction === 'APPROVED') {
                $statusTraked = OrderTrakedFactory::PAYED;
                $statusOrder = OrderFactory::PAYED;
            }
            if ($statusTransaction === 'REJECTED') {
                $statusTraked = OrderTrakedFactory::REJECTED;
                $statusOrder = OrderFactory::REJECTED;
            }
            $orderPending->status = $statusTraked;
            $orderPending->save();

            $order->status = $statusOrder;
            $order->save();
        }
    }
}
