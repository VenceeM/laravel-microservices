<?php

namespace App\Services\Bulletin;

use App\Services\ExternalRequest\Request;

class BulletinService
{

    public $baseUri;
    public function __construct()
    {
        $this->baseUri = config('services.bulletin.base_uri');
    }

    public function login($data)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('post', '/api/login', $data));
    }

    public function index()
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('get', '/api/get'));
    }

    public function store($data)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('post', '/api/create', $data));
    }

    public function update($data, $id)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('post', "/api/update/{$id}", $data));
    }

    public function show($id)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('get', "/api/show/{$id}"));
    }

    public function destroy($id)
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('delete', "/api/destroy/{$id}"));
    }
}
