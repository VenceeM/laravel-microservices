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

    public function register($data)
    {
        $request = (new Request($this->baseUri));
        // dd(json_decode($request->HttpRequest('post', '/api/register', $data)));
        return json_decode($request->HttpRequest('post', '/api/register', $data));
    }

    public function login($data)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('post', '/api/login', $data));
    }

    public function user()
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('get', '/api/user'));
    }


    public function logout()
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('post', '/api/logout'));
    }

    public function middleware()
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('get', '/api/scope/admin'));
    }
}
