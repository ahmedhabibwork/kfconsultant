<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class ApiKeyMiddleware
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
        $apiKey = $request->header('X-API-KEY');
        //get current Route
        $currentRoute = Route::current()->getName();
        if(!in_array($currentRoute,['payment-success','tabby-payment-success','payment-failed',
           'handle-tabby-corner-case'
        ])){

          if (!(App::environment(['local']))) {
            if ($apiKey !== config('services.custom_api.key')) {
                return response()->json(['error' => 'Invalid API key.'], 401);
            }
        }

        }


        return $next($request);
    }
}
