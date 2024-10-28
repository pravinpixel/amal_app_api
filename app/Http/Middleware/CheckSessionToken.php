<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CheckSessionToken
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->header('Session-ID');
        $sessionToken = $request->header('Session-Token');
        if (!$sessionId || !$sessionToken) {
            return response()->json(['error' => 'Required headers not found'], 401);
        }
        $session = DB::table('session_tokens')->where('id', $sessionId)->first();
        if (!$session || $session->token !== $sessionToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $expiresAt = Carbon::parse($session->expiry);
        if (Carbon::now()->greaterThan($expiresAt)) {
            DB::table('session_tokens')->where('id', $sessionId)->delete();
            return response()->json(['error' => 'Session expired'], 401);
        }
        return $next($request);
    }
}
