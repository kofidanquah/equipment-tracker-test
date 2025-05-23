<?php

namespace App\Classes;

use App\Models\User;
use DB;

class UserClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function changePassword($password, $user_id){
        return DB::transaction(function() use($password, $user_id){
            $user = User::find($user_id);
            $user->password = $password;
            $user->password_status = '1';
            return $user->save();
        });
    }
}
