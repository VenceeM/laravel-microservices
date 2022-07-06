<?php

namespace App\Services\ExternalRequest;

use GuzzleHttp\Client;

class Request
{

    public $baseUri;
    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function HttpRequest($method, $uri, $form_params = [], $headers = [], $token)
    {

        $client = new Client([
            'base_uri' => $this->baseUri
        ]);



        if (request()->cookie('jwt')) {
            $headers['Authorization'] = 'Bearer ' . request()->cookie('jwt');
        }
        if (!request()->cookie('jwt') && $token) {
            $headers['Authorization'] = $token;
        }

        $response = $client->request($method, $uri, ['form_params' => $form_params, 'headers' => $headers]);

        return $response->getBody()->getContents();
    }
}
