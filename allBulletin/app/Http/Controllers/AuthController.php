<?php

namespace App\Http\Controllers;

use App\Services\UserService\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password');
        $user = $this->userService->register($data);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password') + ['scope' => 'admin'];

        $user = $this->userService->login($data);

        $cookie = cookie('jwt', $user->token, 60 * 24);

        return response()->json($user)->withCookie($cookie);
    }

    public function user()
    {
        $user = $this->userService->user();

        return response()->json($user);
    }
}
