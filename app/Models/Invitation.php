<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Invitation extends Model implements JWTSubject
{
    protected $table = 'invitations';

    protected $fillable = [
        'email',
        'token',
    ];
    function getJWTIdentifier()
    {
        return $this->getKey();
    }
    function getJWTCustomClaims()
    {
        return [];
    }
}
