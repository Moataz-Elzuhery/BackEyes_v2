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
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
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



    public function resent_verify_code()
    {
        if($this->user == null) {
            return $this->returnError('403', 'Unauthenticated user');
        }

        $auth_user = $this->user;
        $user = User::where('id', $auth_user->id)->first();

        if ($user->verified == 0) {

            $row = VerifyUser::where('user_id', $user->id)->where('status', 0)->orderBy('id', 'desc')->first();

            if ($row == null) {

                $code = $this->unique_code();

                VerifyUser::create([
                    'user_id' => $user->id,
                    'code' => $code,
                    'status' => 0
                ]);

                try {
                    Mail::to($user->email)->send(new VerifyUserMail($user, $code));
                } catch(Exception $e) {
                    //dd($e->getMessage());
                    Log::info($e->getMessage());

                }

                return $this->returnSuccessMessage('code is sent successfully');

            } else {

                $currunt_date_time = Carbon::now()->format('Y-m-d H:i:s');
                $currunt_date_time = Carbon::parse($currunt_date_time);

                $created_at = $row->created_at;
                $created_at = Carbon::parse($created_at);

                $minutes = $created_at->diffInMinutes($currunt_date_time, false);

                if ($minutes >= 2) {
                    ////////////
                    $code = $this->unique_code();

                    VerifyUser::create([
                        'user_id' => $user->id,
                        'code' => $code,
                        'status' => 0
                    ]);

                    try {
                        Mail::to($user->email)->send(new VerifyUserMail($user, $code));
                    } catch(Exception $e) {
                        //dd($e->getMessage());
                        Log::info($e->getMessage());
                    }

                    return $this->returnSuccessMessage('code is sent successfully');

                } else {

                    $message = 'Please wait for 2 minutes and resubmit the code again';

                    return $this->returnError('E100', $message);
                }
            }
        } else {
            return $this->returnSuccessMessage('Your mail has already been verified');
        }
    }


    public function post_verify(Request $request)
    {
        if($this->user == null) {
            return $this->returnError('403', 'Unauthenticated user');
        }

        $auth_user = $this->user;
        $user = User::where('id', $auth_user->id)->first();

        $validated_arr = [
            'code' => 'required|exists:verify_user,code'
        ];

        $validator = Validator::make($request->all(), $validated_arr);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $row = VerifyUser::where('code', $request->code)->where('user_id', $user->id)->orderBy('id', 'desc')->first();

        if ($row == null) {
            return $this->returnError('404', 'This code is incorrect, please check the code again');
        } elseif ($row != null) {

            if ($row->status == 1) {

                return $this->returnSuccessMessage('Your membership has already been verified');

            } elseif ($row->code = $request->code) {

                $currunt_time = Carbon::parse(Carbon::now());

                $created = Carbon::parse($row->created_at);

                $hours = $created->diffInHours($currunt_time, true);

                if ($hours <= 0) {
                    ////////////////////////////
                    $row->update(['status' => 1]);
                    $user->update(['verified' => 1]);

                    return $this->returnSuccessMessage('Your account is verified successfully');

                } else {
                    ///////////////////
                    $code = $this->unique_code();

                    VerifyUser::create([
                        'user_id' => $user->id,
                        'code' => $code,
                    ]);

                    try {
                        Mail::to($user->email)->send(new VerifyUserMail($user, $code));
                    } catch(Exception $e) {
                        //dd($e->getMessage());
                        Log::info($e->getMessage());
                    }

                    return $this->returnError('E100', 'This code is invalid. Another code has been sent to your email');
                }

            } else {
                return $this->returnError('E100', 'This code is incorrect, please check the code again');
            }

        } else {
            return $this->returnError('E100', 'This code is incorrect, please check the code again');
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
