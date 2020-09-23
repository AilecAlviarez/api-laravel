<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class verifiedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    use ApiResponser;
    public function handle(Request $request, Closure $next)
    {

        $payload=auth()->payload();
        if($payload['role']==User::ADMIN){
            return $next($request);
        }
        return $this->errorResponse(['error'=>'permission denied','payload'=>$payload['role']],);


    }
}
