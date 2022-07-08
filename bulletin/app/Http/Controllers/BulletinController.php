<?php

namespace App\Http\Controllers;

use App\Jobs\BulletinCreated;
use App\Jobs\BulletinDeleted;
use App\Jobs\Bulletins;
use App\Jobs\BulletinUpdated;
use App\Models\Bulletin;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {

        $bulletin = Bulletin::all();

        return response()->json($bulletin);
    }

    public function store(Request $request)
    {


        $user = $this->userService->user($request->header('Authorization'));

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);
        $bulletin = Bulletin::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        $user = collect($user)->toArray();
        $data = [
            'bulletin' => $bulletin->toArray(),
            'user' => $user
        ];

        BulletinCreated::dispatch($data);

        return response()->json($bulletin);
    }

    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        $bulletin = Bulletin::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $fields['title'],
                'description' => $fields['description']
            ]
        );

        BulletinUpdated::dispatch($bulletin->toArray());

        return response()->json($bulletin);
    }

    public function show($id)
    {
        $bulletin = Bulletin::find($id);

        return response()->json($bulletin);
    }

    public function destroy($id)
    {
        $bulletin = Bulletin::destroy($id);
        BulletinDeleted::dispatch($id);
        return response()->json($bulletin);
    }
}
