<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

class clientMiddlewaare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->bearerToken() || !Auth::guard('Sanctum')->check()) {
            return response()->json([
                'status_code' => '401',
                'status_message' => 'le client n\'est pas connecté!',
                'data' => null
            ], 401);
        }
        return $next($request);
    }
}
