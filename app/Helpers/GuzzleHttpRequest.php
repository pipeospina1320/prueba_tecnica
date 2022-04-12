<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use PHPUnit\Runner\Exception;
use Symfony\Component\HttpFoundation\Response;

class GuzzleHttpRequest
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function post($url, array $headers, array $formParams = [], $body = null)
    {
        try {
            $response = $this->client->request('POST', $url, [
                'headers' => $headers,
                'http_errors' => false,
                'form_params' => $formParams,
                'json' => $body,
            ]);
            return $this->response($response);
        } catch (Exception $e) {
            throw new Exception($e, $e->getCode());
        }
    }

    public function get($url, array $headers, array $query = [])
    {
        try {
            $response = $this->client->request('GET', $url, [
                'headers' => $headers,
                'http_errors' => false,
                'query' => $query,
            ]);
            return $this->response($response);
        } catch (Exception $e) {
            throw new Exception($e, $e->getCode());
        }
    }

    public function put($url, array $headers, array $formParams = [], $body = null)
    {
        // TODO: Implement patch() method.
    }

    public function patch($url, array $headers)
    {
        // TODO: Implement patch() method.
    }

    public function delete($url, array $headers)
    {
        // TODO: Implement delete() method.
    }

    private function response($response): array
    {
        $statusCode = $response->getStatusCode();
        $content = json_decode(utf8_encode($response->getBody()->getContents()));

        if ($statusCode !== Response::HTTP_OK && $statusCode !== Response::HTTP_CREATED) {
            throw new Exception(json_encode(['message' => $content ?? ""]));
        }
        return (array)$content;
    }
}
