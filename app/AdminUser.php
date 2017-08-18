<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable as Authenticatable;


class AdminUser extends Model implements AuthenticatableContract
{
    use Authenticatable;
    //use AuthenticatableContract;
    protected $table = 'users';
    protected $fillable = [
        'username', 'password'
    ];

    public function fetchData($username){
        //return DB::table('admin_user')->where('username','=', $username)->first();
        return AdminUser::where('username','=', $username)->first();
    }
}
