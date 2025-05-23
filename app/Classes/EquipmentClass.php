<?php

namespace App\Classes;

use App\Models\Equipment;
use DB;

class EquipmentClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function addEquipment($name, $serial_number, $date, $department, $image)
    {
        return DB::transaction(function () use ($name, $serial_number, $date, $department, $image) {
            $equipment = new Equipment();
            $equipment->name = $name;
            $equipment->serial_number = $serial_number;
            $equipment->date_of_purchase = $date;
            $equipment->department_id = $department;
            $equipment->status = '1';
            $equipment->image = $image;
            return $equipment->save();
        });
    }

    public function changeStatus(Equipment $equipment)
    {
        return DB::transaction(function () use ($equipment) {
            $equipment->status = $equipment->status == '1' ? '0' : '1';
            return $equipment->save();
        });
    }
    public function updateEquipment($name, $serial_number, $date, $department, $image, Equipment $equipment)
    {
        return DB::transaction(function () use ($name, $serial_number, $date, $department, $image, $equipment) {
            $equipment->name = $name;
            $equipment->serial_number = $serial_number;
            $equipment->date_of_purchase = $date;
            $equipment->department_id = $department;
            $equipment->image = $image;
            return $equipment->save();
        });
    }
}
