<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
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
        $response = $this->userService->register($data);

        return response()->json($response);
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password') + ['scope' => 'admin'];

        $response = $this->userService->login($data, $request->header('Authorization'));

        $cookie = cookie('jwt', $response->token, 60 * 24);

        return response()->json(['message' => 'sucess'])->withCookie($cookie);
    }
}
