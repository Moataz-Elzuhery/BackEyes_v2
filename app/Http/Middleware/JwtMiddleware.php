<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class JwtMiddleware
{

    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // $access_token = Request::header('Authorization');

        $user = null;

        try {

            $user = JWTAuth::parseToken()->authenticate();

            if($user != null) {

                $auth_user = User::where('id',$user->id)->first();

                $token = auth()->guard('user-api')->login($auth_user, true);

                $auth_user->update([
                    'token' => $token
                ]);
            }

        } catch(\Exception $e) {

            if($e instanceof TokenInvalidException) {

                return $this->returnError('E3001','INVALID_TOKEN');

            } elseif ($e instanceof TokenExpiredException) {

                return $this->returnError('E3002','EXPIRED_TOKEN');

            } else {

                return $this->returnError('E3003','TOKEN_NOT_FOUND');
            }

        } catch(\Throwable $e) {


            if($e instanceof TokenInvalidException) {

                return $this->returnError('E3001','INVALID_TOKEN');

            } elseif ($e instanceof TokenExpiredException) {

                return $this->returnError('E3002','EXPIRED_TOKEN');

            } else {

                return $this->returnError('E3004','TOKEN_NOT_FOUND');
            }

        }

        if(! $user) {
            return $this->returnError('403','Unauthenticated');
        }

        return $next($request);
    }


}
