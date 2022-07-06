<?php

namespace App\Http\Controllers;

use App\Services\Bulletin\BulletinService;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    private $bulletinService;
    public function __construct(BulletinService $bulletinService)
    {
        $this->bulletinService = $bulletinService;
    }

    public function index()
    {

        $bulletin = $this->bulletinService->index();

        return response()->json($bulletin);
    }

    public function store(Request $request)
    {
        $user = (new UserService())->user();
        $data = $request->only('title', 'description') + ['user_id' => $user->id];

        $bulletin = $this->bulletinService->store($data);

        return response()->json($bulletin);
    }

    public function update(Request $request, $id)
    {

        $data = $request->only('title', 'description');

        $bulletin = $this->bulletinService->update($data, $id);

        return response()->json($bulletin);
    }

    public function show($id)
    {
        $bulletin = $this->bulletinService->show($id);

        return response()->json($bulletin);
    }

    public function destroy($id)
    {
        $bulletin = $this->bulletinService->destroy($id);

        return response()->json($bulletin);
    }
}
