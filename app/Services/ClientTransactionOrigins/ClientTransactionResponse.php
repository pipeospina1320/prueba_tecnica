<?php

namespace App\Services\ClientTransactionOrigins;

interface ClientTransactionResponse
{
    public function getTransactionId(): string;

    public function getTransactionStatus(): string;

    public function getTransactionAproved(): bool;

    public function getTransactionStatusMessage(): string;
}
