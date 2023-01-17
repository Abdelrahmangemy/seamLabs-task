<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(Request $request)
    {
        Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('email',$request->email)->first();
        if (!$user) {
            return response(['data'=>'User Not found']);
        } 
        if (Hash::check($request->password, $user->password)) {

            $http = new Client;

            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'aARNIiVCj4Ya1yfzQ7fSmodYVaCl0g9QfldbJJG2',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);

            return response(['data'=>json_decode((string) $response->getBody(), true),'user'=>$user]);
            }
    }
}
