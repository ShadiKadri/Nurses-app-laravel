<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return response()->json(
                [
                    'result' => false,
                    'message' => 'Wrong Credentials'
                ],
                401
            );
        } else {
            if (auth()->attempt($credentials, true)) {

                $token = $user->createToken("ApiToken")->plainTextToken;
                return response()->json([
                    'result' => true,
                    'message' => 'Successfully logged in',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_at' => null,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role->name,
                        'phone_number' => $user->phone_number,
                        'gender' => $user->gender
                    ]
                ]);
            } else {
                return response()->json(
                    [
                        'result' => false,
                        'message' => 'Wrong Credentials'
                    ],
                    401
                );
            }
        }
    }
}
