<?php

namespace App\Http\Controllers;

use App\Services\Bulletin\BulletinService;
use Illuminate\Http\Request;

class BulletinController extends Controller
{

    private $bulletinService;
    public function __construct(BulletinService $bulletinService)
    {
        $this->bulletinService = $bulletinService;
    }
    public function index(Request $request)
    {
        $bulletin = $this->bulletinService->getBulletin();

        return response()->json($bulletin);
    }
}
