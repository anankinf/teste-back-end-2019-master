<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function accessToken(){

        $credentials = request(['email', 'password']);

        if(!$token = Auth::guard('api')->attempt($credentials)){
            return response()->json(['message' => 'Usuário ou senha inválida'], 401);
        }

        return response()->json([
            "data" => [
                'access_token' => $token,
                'expires_in_seconds' => auth('api')->factory()->getTTL() * 60
            ]

        ]);

    }

    public function revokeToken() {

        Auth::guard('api')->logout();
        return response()->json([
            "data" => [
                'message' => "Usuário deslogado com sucesso."
            ]
        ], 200);

    }

    public function refreshToken() {
        $token = Auth::guard('api')->refresh();
        return response()->json([
            "data" => [
                'access_token' => $token,
            ]
        ], 200);
    }

}
