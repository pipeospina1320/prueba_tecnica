<?php

namespace App\Services\ClientTransactionOrigins\ClientRequest\PlaceToPay;

use App\Models\Order;
use Carbon\Carbon;
use DateTimeInterface;
use Exception;

class CreateSessionRequest extends PlaceToPayTransactionRequest
{

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function createSession(Order $order)
    {
        $url = $this->buildPath('api/session');
        return $this->guzzleHttpRequest->post($url, $this->buildHeader(), [], $this->buildBody($order));
    }

    public function buildBody(Order $order): array
    {

        $expire = Carbon::now()->addMinutes(15)->format(DateTimeInterface::ISO8601);;

        return [
            'locale' => 'es_CO',
            'auth' => [
                "login" => $this->login,
                "tranKey" => $this->tranKey,
                "nonce" => base64_encode($this->nonce),
                "seed" => $this->seed
            ],
            "payment" => [
                "reference" => $order->id,
                "description" => "",
                "amount" => [
                    "currency" => "COP",
                    "total" => 100000
                ],
                "allowPartial" => false
            ],
            "expiration" => $expire,
            "returnUrl" => "http://localhost:8000/api/transaction/status?order={$order->uuid}",
            "ipAddress" => "127.0.0.1",
            "userAgent" => "PlacetoPay Sandbox"
        ];
    }
}
