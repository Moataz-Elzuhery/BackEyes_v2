<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    use GeneralTrait;


    // forget_password
    public function forget_password(Request $request)
    {


        $validated_arr = [
            'email' => 'required|email|exists:users,email',
        ];

        $validator = Validator::make($request->all(), $validated_arr);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = User::where('email', $request->email)->first();

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $code = mt_rand(100000, 999999);

        while(ResetCodePassword::where('code', $code)->exists()) {
            $code = mt_rand(100000, 999999);
        }

        $randomString = Str::random(30);

        while(ResetCodePassword::where('token', $randomString)->exists()) {
            $randomString = Str::random(30);
        }

        // Create a new code
        $codeData = ResetCodePassword::create([
            'email' => $request->email,
            'code' => $code,
            'user_id' => $user->id,
            'token' => $randomString
        ]);


        try {
            // Send email to user
            Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));
        } catch(Exception $e) {

        }

        return $this->returnSuccessMessage('We have emailed your password reset code!');

    }



    // verify_code_reset_password
    public function verify_code_reset_password(Request $request)
    {

        $validated_arr = [
            'email' => 'required|email|exists:reset_code_passwords,email',
            'code' => 'required|exists:reset_code_passwords,code',
        ];

        $validator = Validator::make($request->all(), $validated_arr);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        // find the code
        $passwordReset = ResetCodePassword::where('code', $request->code)->where('email', $request->email)->first();

        if($passwordReset == null) {
            return $this->returnError('E200', 'Sorry, please check your code and email again');
        } else {

            $data = [
                'user_id' =>  $passwordReset->user_id,
                'token' =>  $passwordReset->token,
            ];

            return $this->returnData('data', $data);
        }

    }



    // reset_password
    public function reset_password(Request $request)
    {

        $validated_arr = [
            'user_id' => 'required|exists:reset_code_passwords,user_id|exists:users,id',
            'token' => 'required|exists:reset_code_passwords,token',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($request->all(), $validated_arr);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        // find the code
        $passwordReset = ResetCodePassword::where('token', $request->token)->where('user_id', $request->user_id)->first();

        $user = User::where('id', $request->user_id)->first();

        if($passwordReset == null || $user == null) {
            return $this->returnError('E200', 'Sorry, please check your code and email again');
        }

        if($user == null) {
            return $this->returnError('E200', 'Sorry, something went wrong, please try again');
        }

        // update user password
        $user->update(['password' => bcrypt($request->password)]);

        // delete current code
        $passwordReset->delete();

        $credentials = [
            'email' => $user->email,
            'password' => $request->password
        ];

        $token = Auth::guard('user-api')->attempt($credentials);

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->returnData('data', $data, 'Your password has been reset!');

    }





}
