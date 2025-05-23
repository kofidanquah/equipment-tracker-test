<?php

namespace App\Classes;

use App\Models\Department;
use DB;

class DepartmentClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function addDepartment($deptName)
    {
        return DB::transaction(function () use($deptName){
            $dept = new Department();
            $dept->name = $deptName;
            return $dept->save();
        });
    }
}
