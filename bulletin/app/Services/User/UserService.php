<?php

namespace App\Services\User;

use App\Services\ExternalRequest\RequestExternal;

class UserService
{


    public $baseUri;
    public function __construct()
    {
        $this->baseUri = config('services.user.base_uri');
    }

    public function user($token)
    {
        $req = (new RequestExternal($this->baseUri));

        return json_decode($req->HttpRequest('get', '/api/user', [], [], $token));
    }

    public function login($data, $token)
    {
        $req = (new RequestExternal($this->baseUri));

        return json_decode($req->HttpRequest('post', '/api/login', $data, [], $token));
    }

    public function register($data)
    {
        $req = (new RequestExternal($this->baseUri));

        return json_decode($req->HttpRequest('post', '/api/register', $data));
    }

    public function logout()
    {
        $req = (new RequestExternal($this->baseUri));

        return json_decode($req->HttpRequest('post', '/api/logout'));
    }

    public function middleware($token)
    {
        $req = (new RequestExternal($this->baseUri));
        return json_decode($req->HttpRequest('get', '/api/scope/admin', [], [], $token));
    }
}
