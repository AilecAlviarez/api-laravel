<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class buyerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $payload=auth()->payload();
        if($payload['role']==User::NOADMIN){
            return $next($request);
        }
        return $this->errorResponse(['error'=>'permission denied','payload'=>$payload['role']],);
    }
}
