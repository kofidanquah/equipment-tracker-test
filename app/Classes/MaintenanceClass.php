<?php

namespace App\Classes;

use App\Models\Maintenance_Logs;
use DB;

class MaintenanceClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function assignto($equipment, $worker, $maintenance_date, $note)
    {
        return DB::transaction(function() use($equipment, $worker, $maintenance_date, $note){
            $row = new Maintenance_Logs();
            $row->equipment_id = $equipment;
            $row->assigned_to = $worker;
            $row->maintenance_date = $maintenance_date;
            $row->notes = $note;
            return $row->save();
        });
    }
}
