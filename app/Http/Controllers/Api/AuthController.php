<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(!Auth::attempt($data))
            {
                return response()->json(['message' => 'Email atau password salah'], 401);    
            }   
        $user = Auth::user();

        $token = $user->createToken('kms-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user,
        ]);

    }
    public function me(Request $request)
        {
            return response()->json([
                'user'=>$request->user(),

            ]);
        }

        
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil',
        ]);
    }
}
