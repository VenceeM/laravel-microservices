<?php

namespace App\Services\ExternalRequest;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\BadResponseException;

class Request
{

    public $baseUri;
    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function HttpRequest($method, $uri, $form_params = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri
        ]);

        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . request()->cookie('jwt');
        $response = $client->request($method, $uri, ['form_params' => $form_params, 'headers' => $headers, 'http_errors' => false]);

        return $response->getBody()->getContents();
    }
}
