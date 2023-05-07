<?php


namespace App\Http\Middleware;


use App\Models\User;
use App\Services\ResponseHandler;
use Closure;
use Illuminate\Http\Request;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if ($bearer = $request->header('authorization')){
            $authToken = str_replace('Bearer ', '', $bearer);
            $user = User::query()->where('auth_token', $authToken)->first();
            if ($user){
                $request->request->add(['user_id' => $user->id]);
                return $next($request);
            }else{
                $responseHandler = new ResponseHandler();
                return $responseHandler->createResponse(
                    false,
                    'Unauthorized'
                );
            }
        }
    }
}
