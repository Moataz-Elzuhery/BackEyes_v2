<?php

use App\Http\Controllers\ApiMemberController;
use App\Http\Controllers\ApiAlertController;
use App\Http\Controllers\ApiPlaceController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes


// Protected routes
Route::middleware('auth:sanctum')->group(function () {

  



    // Route::post('/logout', function (Request $request) {
    //     $request->user()->tokens()->delete();
    //     return ['message' => 'Tokens Revoked'];
    // });

});


// Guest routes
// Route::middleware('guest:sanctum')->group(function () {
//     Route::post('/login', [UserController::class, 'login']);
//     Route::post('/register', [UserController::class, 'register']);
//     Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
//     Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
//     Route::get('verify-email', [AuthController::class, 'verifyEmail'])->name('verification.verify');
// });




// register
Route::get('register', function () {
    return response()->json([ 'status' => false, 'errNum' => '404', 'msg' => 'bad request' ]);
});

Route::post('register', 'Mobile\AuthController@register');


// login
Route::get('login', function () {
    return response()->json([ 'status' => false, 'errNum' => '404', 'msg' => 'bad request' ]);
});

Route::post('login', 'Mobile\AuthController@login');


Route::post('forget-password', 'Mobile\ResetPasswordController@forget_password');
Route::post('verify-code-reset-password', 'Mobile\ResetPasswordController@verify_code_reset_password');
Route::post('reset-password', 'Mobile\ResetPasswordController@reset_password');



////////////////////// Auth User
Route::group(['middleware' => ['AuthUser:user-api'],'namespace' => 'Mobile'], function () {


    // get-user
    Route::get('get-user', 'ProfileController@get_user');
    Route::get('/user', function (Request $request) {return $request->user();});
    Route::get('/members', [ApiMemberController::class, 'index']);
    Route::get('/members/{id}', [ApiMemberController::class, 'show']);
   Route::post('/members', [ApiMemberController::class, 'store']);
   Route::post('/members/{id}', [ApiMemberController::class, 'update']);
   Route::delete('/members/{id}', [ApiMemberController::class, 'delete']);

   Route::get('/alerts', [ApiAlertController::class, 'index']);
   Route::get('/alerts/{id}', [ApiAlertController::class, 'show']);
   Route::post('/alerts', [ApiAlertController::class, 'store']);
   Route::post('/alerts/{id}', [ApiAlertController::class, 'update']);
   Route::delete('/alerts/{id}', [ApiAlertController::class, 'delete']);

   Route::get('/places', [ApiPlaceController::class, 'index']);
   Route::get('/places/{id}', [ApiPlaceController::class, 'show']);
   Route::post('/places', [ApiPlaceController::class, 'store']);
   Route::post('/places/{id}', [ApiPlaceController::class, 'update']);
   Route::delete('/places/{id}', [ApiPlaceController::class, 'delete']);

    Route::get('logout', function () {
        return response()->json([ 'status' => false, 'errNum' => '404', 'msg' => 'bad request' ]);
    });

    Route::post('logout', 'AuthController@logout');


    // update-profile
    Route::get('update-profile', function () {
        return response()->json([ 'status' => false, 'errNum' => '404', 'msg' => 'bad request' ]);
    });

    Route::post('update-profile', 'ProfileController@update_profile');


    // resent_verify_code
    Route::get('resent-verify-code', 'VerifyController@resent_verify_code');


    // verify-code
    Route::get('verify-code', function () {
        return response()->json([ 'status' => false, 'errNum' => '404', 'msg' => 'bad request' ]);
    });

    Route::post('verify-code', 'VerifyController@post_verify');




});