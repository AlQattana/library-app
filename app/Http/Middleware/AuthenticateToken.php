<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $authorization = $request->header('authorization');
        if (!$authorization) {
            return \response()->json([
                'Please pass th token'
            ]);
        }

        $user = User::where('api_token', $authorization)->first();
        if (!$user) {
            return \response()->json([
                'Invalid Credentials'
            ]);
        }

        return $next($request);
    }
}
