<?php

namespace App\Classes;

use App\Models\User;
use App\Models\Worker;
use DB;
use Hash;
use Mail;
use App\Mail\WorkerPasswordMail;


class WorkerClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function addWorker($name, $email, $role)
    {
        return DB::transaction(function () use ($name, $email, $role) {
            $plainPassword = $this->password();

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($plainPassword);
            $user->save();
            $user->roles()->syncWithoutDetaching([$role]);


            $worker = new Worker();
            $worker->name = $name;
            $worker->email = $email;
            $worker->user_id = $user->id;
            $worker->role = $role;
            $worker->save();

            Mail::to($email)->send(new WorkerPasswordMail($plainPassword));
            return true;
        });
    }

    function password($length = 8)
    {
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= rand(1, 9);
        }
        return $password;
    }
}
