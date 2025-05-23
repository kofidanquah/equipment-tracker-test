<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance_Logs extends Model
{
    use SoftDeletes;

    protected $table = "maintenance_logs";

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
    public function worker()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
