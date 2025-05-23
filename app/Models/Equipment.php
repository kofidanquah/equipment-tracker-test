<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use SoftDeletes;

    protected $table = 'equipments';

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function maintenance()
    {
        return $this->belongsTo(Maintenance_Logs::class);
    }
}
