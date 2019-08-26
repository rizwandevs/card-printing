<?php

namespace App\Http\Middleware;

use App\Http\Controllers\WebController;
use Closure;

class WebSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session('web_session')){
            $webController = new WebController();
            $webController->webSession();
        }
        return $next($request);
    }
}
