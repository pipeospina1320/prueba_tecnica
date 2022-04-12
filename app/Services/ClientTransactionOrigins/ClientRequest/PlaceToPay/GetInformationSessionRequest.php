<?php

namespace App\Services\ClientTransactionOrigins\ClientRequest\PlaceToPay;

use Exception;

class GetInformationSessionRequest extends PlaceToPayTransactionRequest
{

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getRequestInformation(string $requestId)
    {
        $url = $this->buildPath("api/session/{$requestId}");
        return $this->guzzleHttpRequest->post($url, $this->buildHeader(), [], $this->buildBody());
    }

    public function buildBody(): array
    {
        return [
            'locale' => 'es_CO',
            'auth' => [
                "login" => $this->login,
                "tranKey" => $this->tranKey,
                "nonce" => base64_encode($this->nonce),
                "seed" => $this->seed
            ],
        ];
    }
}
