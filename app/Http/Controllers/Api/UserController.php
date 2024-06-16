<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\IniteService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserService $userService;
    private IniteService $inviteService;
    public function __construct(UserService $userService, IniteService $inviteService)
    {
        $this->userService = $userService;
        $this->inviteService = $inviteService;
    }

    public function invite(Request $request)
    {

        $roles = array_unique($request->roles);

        $accessibleRoles = [3, 4];

        if ($unexeptobleRoles = array_diff($roles, $accessibleRoles)) {
            return response()->json(
                [
                    'error' => 'unexeptoble roles',
                    'roles' =>  $unexeptobleRoles,
                ],
                500
            );
        }


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create(['email' => $request->email]);
            $this->inviteService->invite($user);
        }

        $roles = Role::whereIn('id', $roles)->get();
        $user->roles()->sync($roles);

        $token = JWTAuth::fromUser($user);

        return response()->json(
            [
                'token' =>  $token,

            ],
            200
        );
    }
    public function activate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(
                [
                    'error' => 'user not found',
                ],
                500
            );
        }

        if (!$user->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json(
            [],
            200
        );
    }
}
