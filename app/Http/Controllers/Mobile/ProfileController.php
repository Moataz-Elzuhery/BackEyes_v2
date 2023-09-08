<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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


    // update-profile
    public function update_profile(Request $request)
    {

        if($this->user == null) {
            return $this->returnError('403', 'Unauthenticated user');
        }

        $auth_user = $this->user;
        $user = User::where('id', $auth_user->id)->first();

        try {

            $validated_arr = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6|max:50',
            ];

            $validator = Validator::make($request->all(), $validated_arr);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $input = $request->only([ 'name', 'email' ]);

            if($request->password != null) {
                $input['password'] =  bcrypt($request->password);
            }

            ////////
            $user->update($input);

            return $this->returnData('user', $user, 'Profile updated successfully');

        } catch(Exception $e) {
            //dd($e->getMessage());
            Log::info($e->getMessage());
            return $this->returnError('E200', 'sorry try again');
        }

    }


    // get-user
    public function get_user(Request $request)
    {

        $auth_user = Auth::guard('user-api')->user();

        if($auth_user == null) {
            return $this->returnError('403', 'Unauthenticated user');
        }

        $user = User::where('id', $auth_user->id)->select([ 'id','name', 'email','verified' ])->first();

        return $this->returnData('user', $user);

    }





}
