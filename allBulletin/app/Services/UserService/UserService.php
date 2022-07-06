<?php

namespace App\Services\UserService;

use App\Services\ExternalRequest\Request;

class UserService
{


    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.user.base_uri');
    }

    public function middlware($token)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('get', '/api/scope/admin', [], [], $token));
    }

    public function login($data)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('post', '/api/login', $data));
    }

    public function register($data)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('post', '/api/register', $data));
    }

    public function user()
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('get', '/api/user'));
    }
}
