<?php

namespace App\Models\users;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Brand
 *
 * @property int $id
 * @property string|null $user_name
 * @property string|null moblie
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Users extends Model
{
    //
    protected $hidden = ['created_at','updated_at','deleted_at','last_login_ip','last_login_at'];

    public function promission()
    {
        return $this->hasMany('App\Models\UsersPromissionAssioc','u_id');
    }
}
