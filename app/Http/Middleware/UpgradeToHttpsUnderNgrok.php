<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class UpgradeToHttpsUnderNgrok
{
    public function handle(Request $request, Closure $next): Response
    {
            // Solo forzar HTTPS bajo ciertas condiciones
            if (str_ends_with($request->getHost(), '.ngrok-free.app')) {
                URL::forceScheme('https');
            }
            
        

        return $next($request);
    }
}
