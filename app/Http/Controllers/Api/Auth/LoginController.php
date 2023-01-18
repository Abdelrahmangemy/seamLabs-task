<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $credentals = request(['email', 'password']);

        if (!Auth::attempt($credentals)) {
            return respone()->json(['message', 'User Unauthorized'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token ->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return json_decode(['data' => [
            'user' => Auth::user(),
            'access_token' => $tokenResult->access_token,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]]);
    }
}
