<?php

namespace App\Services\ClientTransactionOrigins;

interface ClientTransactionRequest
{
    public function buildPath(string $path): string;

    public function getUrl();

    public function buildHeader(): array;

//    public function buildBody(): array;
}
