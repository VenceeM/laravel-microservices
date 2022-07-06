<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        return response()->json([
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($fields)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('authToken', [$request->input('scope')])->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function scopeCan(Request $request, $scope)
    {

        if (!$request->user()->tokenCan($scope)) {
            return response()->json(['message' => 'Unauthorize'], 401);
        }

        return response()->json([
            'message' => 'Ok'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json('Logged out');
    }

    public function user(Request $request)
    {
        $user = $request->user();

        return response()->json($user);
    }
}
