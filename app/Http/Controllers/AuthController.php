<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {
            $uri = config('services.passport.login_endpoint');
            $params = [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ];

            $response = $http->post($uri, $params);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getCode() === 400) {
                return response()->json(['message' => 'Invalid Request. Please enter a username or a password.'], $e->getCode());
            } else if($e->getCode() === 401) {
                return response()->json(['message' => 'Your credentials are incorrect. Please try again.'], $e->getCode());
            }

            return response()->json(['message' => 'Something went wrong on the server.'], $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $params = ['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)];
        $response = User::create($params);

        return $response;
    }

    public function logout()
    {
        auth()->user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully!');
    }
}
