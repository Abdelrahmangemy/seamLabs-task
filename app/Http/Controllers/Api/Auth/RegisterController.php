<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phoneNumber' => 'required|numeric|digits:10',
            'dateOfBirth' => 'required|date|date_format|Y-m-d|before:today'
        ]);

        $user = User::firstOrNew(['email'=>$request->email]) ;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phoneNumber = $request->phoneNumber;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->save();

        $http = new Client;

        $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'jC5NMxRlXmT3UOYsdAWrAH2QAA77iPqpXbiB60KD',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
