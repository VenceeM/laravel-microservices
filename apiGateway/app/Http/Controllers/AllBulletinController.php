<?php

namespace App\Http\Controllers;

use App\Services\AllBulletin\AllBulletinService;
use Illuminate\Http\Request;

class AllBulletinController extends Controller
{
    private $service;
    public function __construct(AllBulletinService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $service = $this->service->index();

        return response()->json($service);
    }
}
