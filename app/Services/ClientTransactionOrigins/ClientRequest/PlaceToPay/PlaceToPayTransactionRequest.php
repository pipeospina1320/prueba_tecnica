<?php

namespace App\Services\ClientTransactionOrigins\ClientRequest\PlaceToPay;

use App\Helpers\GuzzleHttpRequest;
use App\Services\ClientTransactionOrigins\ClientTransactionRequest;
use Carbon\Carbon;
use DateTimeInterface;
use Exception;
use Illuminate\Support\Str;

abstract class PlaceToPayTransactionRequest implements ClientTransactionRequest
{

    protected GuzzleHttpRequest $guzzleHttpRequest;
    protected string $login;
    protected string $secretkey;
    protected string $tranKey;
    protected string $nonce;
    protected string $seed;
    protected string $apiPath;

    public function __construct()
    {
        $this->guzzleHttpRequest = new GuzzleHttpRequest();
        $this->apiPath = env('URL_PLACE_TO_PAY');
        $this->login = env('LOGIN_PLACE_TO_PAY');
        $this->secretkey = env('SECRET_PLACE_TO_PAY');
        $this->nonce = Str::uuid()->toString();
        $this->seed = Carbon::now()->format(DateTimeInterface::ISO8601);
        $this->tranKey = base64_encode(sha1($this->nonce . $this->seed . $this->secretkey, true));
    }

    /**
     * @param string $path
     * @return string un path hacia una ruta especificada para este origen
     */
    public function buildPath(string $path): string
    {
        return "{$this->apiPath}/{$path}";
    }

    /**
     * @throws Exception
     */
    public function getUrl(): string
    {
        if (!$this->apiPath) {
            throw new Exception('No existe la url configurada para place to pay');
        }
        return $this->apiPath;
    }

    public function buildHeader(): array
    {
        return [
            'Accept' => "application/json",
            'Content-Type' => 'application/json',
        ];
    }
}
