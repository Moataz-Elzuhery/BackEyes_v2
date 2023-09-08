<?php

namespace App\Traits;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($errorNumber, $message)
    {
        return response()->json([
            'status' => false,
            'errorNumber' => $errorNumber,
            'message' => $message
        ]);
    }

    public function returnResponseWithLink($status,$errorNumber, $message,$link)
    {
        return response()->json([
            'status' => $status,
            'errorNumber' => $errorNumber,
            'message' => $message,
            'link' => $link
        ]);
    }


    public function returnSuccessMessage($message = "", $errorNumber = "200")
    {
        return [
            'status' => true,
            'errorNumber' => $errorNumber,
            'message' => $message
        ];
    }

    public function returnData($key, $value, $message = "")
    {
        return response()->json([
            'status' => true,
            'errorNumber' => "200",
            'message' => $message,
            $key => $value
        ]);
    }


    //////////////////
    public function returnValidationError($code, $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        return "E700";
    }


    // 200 success
    // 401 Unauthorized User

    // 403 Unauthenticated user //
    // 404 not found


    // E100 error with message  //
    // E200 catch error //
    // E300 required error //
    // E400 hold data //

    // E600 payment faild  //
    // E700 validation error //

    // E3001 INVALID_TOKEN //
    // E3002 EXPIRED_TOKEN //
    // E3003 TOKEN_NOT_FOUND //

}
