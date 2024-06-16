<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }
    public function login(Request $request)
    {
        $creditials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($creditials)) {
            return response()->json([], 500);
        }

        $user = auth('api')->user();

        return response()->json(
            [
                'access_token' => $token,
                'companies' => $user->company()->get()->pluck('id'),
                'roles' => $user->roles()->get()->pluck('id'),
                // 'type' => 'Bearer',
                // 'expires_in' => Config::get('jwt.ttl')
            ],
            200
        );
    }
}
