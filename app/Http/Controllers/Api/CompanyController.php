<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\IniteService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    private IniteService $inviteService;
    public function __construct(IniteService $inviteService)
    {
        $this->inviteService = $inviteService;
    }
    public function invite(Request $request)
    {

        if (Company::where('name', $request->companyName)->first()) {
            return response()->json(
                [
                    'error' => 'company already exist'
                ],
                500
            );
        }

        $user = User::where('email', $request->email)->first() ?? User::create(['email' => $request->email]);
       
        $companyOwnerRole = Role::find(2);
        $user->roles()->sync($companyOwnerRole);

        $token = JWTAuth::fromUser($user);

        $this->inviteService->invite($user);

        $company = new Company();
        $company->name = $request->companyName;
        $company->save();

        $user->company()->sync($company);

        return response()->json(
            [

                'token' => $token
            ],
            200
        );
    }
}
