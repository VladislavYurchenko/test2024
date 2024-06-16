<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UsersCompanies extends Model 
{
    protected $table = 'users_companies';

    use HasFactory;
   
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
