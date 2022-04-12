<?php

namespace App\Services\ClientTransactionOrigins\ClientResponse\PlaceToPay;

use App\Services\ClientTransactionOrigins\ClientTransactionResponse;

class PlaceToPayResponse implements ClientTransactionResponse
{
    protected array $resp;

    public function __construct(array $resp)
    {
        $this->resp = $resp;
    }

    public function getTransactionId(): string
    {
        return $this->resp['requestId'];
    }

    public function getTransactionStatus(): string
    {
        return $this->resp['status']->status;
    }

    public function getTransactionAproved(): bool
    {
        return $this->getTransactionStatus() === 'APPROVED';
    }

    public function getTransactionStatusMessage(): string
    {
        return $this->resp['status']->message;
    }
}
