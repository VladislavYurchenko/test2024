<?

namespace App\Services;

use App\Models\Invitation;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class IniteService
{
    function invite(User $user)
    {
        $invite = new Invitation();
        $token = JWTAuth::fromUser($user);


        $invite->email = $user->email;
        $invite->token = $token;

        $invite->save();
    }
}
