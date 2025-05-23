<?php

namespace App\Classes;

use App\Models\Role;
use DB;
use Str;

class RoleClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function addRole($name, $description){
        return DB::transaction(function() use($name, $description){
            $role = new Role();
            $role->name = $name;
            $role->slug = Str::slug($name);
            $role->description = $description;
            $role->save();

            return $role;
        });
    }
}
