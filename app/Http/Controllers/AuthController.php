<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);

    $credentials = request(['email', 'password']);
    if(!Auth::attempt($credentials))
      return response()->json([
        'message' => 'Unauthorized'
      ], 401);

    $user = $request->user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->token;

    if ($request->remember_me)
      $token->expires_at = Carbon::now()->addWeeks(1);
    $token->save();

    return response()->json([
      'token' => $tokenResult->accessToken,
      'user' => $user,
      'token_type' => 'Bearer',
      'expires_at' => Carbon::parse(
        $tokenResult->token->expires_at
      )->toDateTimeString()
    ]);
  }

  public function logout(Request $request)
  {
    $request->user()->token()->revoke();
    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }

  public function user(Request $request)
  {
    return response($request->user());
  }
}
