<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class ApiLogin
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $secret = DB::table('oauth_clients')
                        ->where('id',2)
                        ->pluck('secret')
                        ->first();

        $request->merge([
            'grand_type' => 'password',
            'client_id' => 2,
            'client_secret' => $secret,
        ]);
        return $next($request);
    }
}
