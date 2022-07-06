<?php

namespace App\Http\Middleware;

use App\Services\UserService\UserService;
use Closure;
use Illuminate\Http\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $middlware = (new UserService())->middleware();

        if (!$middlware->message == 'ok') {
            return response()->json(['message' => 'unauthorize'], 401);
        }

        return $next($request);
    }
}
