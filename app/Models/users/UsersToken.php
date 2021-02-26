<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Model;

class UsersToken extends Model
{
    //
    protected $table = 'users_token';
    protected $hidden = ['created_at','updated_at','deleted_at'];
}
