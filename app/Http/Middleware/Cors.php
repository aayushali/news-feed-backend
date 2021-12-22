<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $domains = ['http://localhost:8083','http://localhost:8081','http://localhost:8080'];

        if (isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            if (in_array($origin, $domains)) {
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, Fiscal-Year');
            }
        }
        return $next($request)->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
