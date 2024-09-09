<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ValidateTokenMiddleware
{
    public function handle($request, Closure $next, ...$allowedRoles)
    {
        $token = $request->bearerToken();

        $accessToken = PersonalAccessToken::where('token', $token)->first();
        if (!$token) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        //check if the role_id from the token is authorized to view this page
        if (!in_array(json_decode($accessToken->abilities)->role_id, $allowedRoles)) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        $user = $accessToken->tokenable;

        $request->merge(['authenticated_user' => $user]);
        $request->merge(['bearer_token' => $token]);

        return $next($request);
    }
}
