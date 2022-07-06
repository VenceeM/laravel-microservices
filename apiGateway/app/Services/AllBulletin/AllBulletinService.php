<?php

namespace App\Services\AllBulletin;

use App\Services\ExternalRequest\Request;

class AllBulletinService
{
    public $baseUri;
    public function __construct()
    {
        $this->baseUri = config('services.allBulletin.base_uri');
    }

    public function index()
    {
        $request = (new Request($this->baseUri));

        return json_decode($request->HttpRequest('get', '/api/get'));
    }
}
