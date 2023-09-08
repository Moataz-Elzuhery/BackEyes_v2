<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Mail\VerifyUserMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifyUser;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use GeneralTrait;

    public $user;

    public function __construct()
    {
        // $user = JWTAuth::parseToken()->authenticate();
        $auth_user = Auth::guard('user-api')->user();

        if($auth_user != null) {
            $this->user = User::where('id', $auth_user->id)->first();
        } else {
            $this->user = null;
        }
    }



    // register
    public function register(Request $request)
    {

        try {

            $validated_arr = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:50',
            ];

            $validator = Validator::make($request->all(), $validated_arr);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $input = $request->only([ 'name', 'email' ]);

            $input['password'] =  bcrypt($request->password);
            $input['verified'] = 0;

            //Request is valid, create new user
            $auth_user = User::create($input);

            $code = $this->unique_code();

            VerifyUser::create([
                'user_id' => $auth_user->id,
                'code' => $code,
                'status' => 0
            ]);

            try {
                Mail::to($auth_user->email)->send(new VerifyUserMail($auth_user, $code));
            } catch(Exception $e) {
                //dd($e->getMessage());
                Log::info($e->getMessage());

            }

            $user = User::where('id', $auth_user->id)->first();

            $credentials = $request->only(['email', 'password']);
            $token = Auth::guard('user-api')->attempt($credentials);

            $user->api_token = $token;

            return $this->returnData('user', $user, 'User created successfully and waiting for verifying your account');

        } catch(Exception $e) {
            //dd($e->getMessage());
            Log::info($e->getMessage());
            return $this->returnError('E200', 'sorry try again');
        }

    }


    // login
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $validated_arr = [
            'email' => 'required|exists:users|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $validated_arr);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        //Request is validated

        $token = Auth::guard('user-api')->attempt($credentials);

        //Creat token and return user with token
        try {

            if (! $token) {
                return $this->returnError('401', 'please check your email and password again');
            } else {

                $auth_user = Auth::guard('user-api')->user();

                $user = User::where('id', $auth_user->id)->first();

                $user = $user->toArray();

                $user['api_token'] = $token;

                $msg = 'login successfully';

                return $this->returnData('user', $user, $msg);
            }

        } catch (JWTException $e) {
            return $this->returnError('E200', 'sorry try again');
        }

    }




    // logout
    public function logout(Request $request)
    {


        try {
            // Adds token to blacklist.
            $forever = true;

            JWTAuth::parseToken()->invalidate($forever);
            return $this->returnSuccessMessage('log out successfully');

        } catch (TokenExpiredException $exception) {

            return $this->returnError('E100', 'EXPIRED TOKEN');

        } catch (TokenInvalidException $exception) {

            return $this->returnError('E100', 'INVALID TOKEN');

        } catch (JWTException $exception) {

            return $this->returnError('E100', 'MISSING TOKEN');

        }
    }





    private function unique_code()
    {
        $uniqueCode = random_int(100000, 999999);

        while (VerifyUser::where('code', $uniqueCode)->exists()) {
            $uniqueCode = random_int(100000, 999999);
        }

        return $uniqueCode;
    }



}
