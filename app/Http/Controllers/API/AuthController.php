<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostLoginRequest;

class AuthController extends Controller
{
    public function login(PostLoginRequest $request)
    {
        $check = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (!$check) {
            return response()->json([
                'success' => false,
                'message' => 'credentials not match'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('login')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'successful login',
            'data' => [
                'user' => $user,
                'token' => $token,
                'tokenType' => 'Bearer'
            ]
        ], 200);
    }
}
