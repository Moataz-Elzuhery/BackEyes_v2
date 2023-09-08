<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
public function register(Request $request)
{
$validator = Validator::make($request->all(), [
'name' => 'required|string|max:255',
'email' => 'required|string|email|unique:users|max:255',
'password' => 'required|string|min:8',
]);

if ($validator->fails()) {
return response()->json($validator->errors(), 400);
}

$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => bcrypt($request->password),
]);

$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([
'user' => $user,
'token' => $token
], 201);
}

public function login(Request $request)
{
$validator = Validator::make($request->all(), [
'email' => 'required|string|email',
'password' => 'required|string',
]);

if ($validator->fails()) {
return response()->json($validator->errors(), 400);
}

if (!Auth::attempt($request->only('email', 'password'))) {
return response()->json([
'message' => 'Invalid login credentials'
], 401);
}

$user = User::where('email', $request->email)->firstOrFail();
$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([
'user' => $user,
'token' => $token
], 200);
}

public function logout(Request $request)
{
$request->user()->currentAccessToken()->delete();

return response()->json([
'message' => 'Logged out successfully'
], 200);
}
}