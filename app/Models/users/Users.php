<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $hidden = ['created_at','updated_at','deleted_at','last_login_ip','last_login_at'];
}
