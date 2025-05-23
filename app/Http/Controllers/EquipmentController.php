<?php

namespace App\Http\Controllers;

use App\Classes\EquipmentClass;
use App\Http\Requests\EquipmentRequest;
use App\Models\Department;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $pgdata;
    public $equipmentClass;

    public function __construct()
    {
        $this->pgdata = [
            'heading' => 'Equipments',
            'pg' => 'equipment',
        ];

        $this->equipmentClass = new EquipmentClass();
    }
    public function index()
    {
        return view('equipments.list', $this->pgdata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->pgdata['departments'] = Department::all();
        return view('equipments.new', $this->pgdata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipmentRequest $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $image = $path;
        } else {
            $image = "";
        }

        $stmt = $this->equipmentClass->addEquipment($request->name, $request->serial_number, $request->date, $request->department, $image);

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Equipment Created Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Equipment Creation Failed'];
        }

        return redirect()->route('equipment.index')->with($status['status'], $status['msg']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        $this->pgdata['equipment'] = $equipment;
        $this->pgdata['departments'] = Department::all();
        return view('equipments.edit', $this->pgdata);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $image = $path;
        } else {
            $image = $equipment->image;
        }

        $stmt = $this->equipmentClass->updateEquipment($request->name, $request->serial_number, $request->date, $request->department, $image, $equipment);

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Equipment Updated Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Equipment Update Failed'];
        }

        return redirect()->route('equipment.index')->with($status['status'], $status['msg']);
    }


    public function changeStatus(Equipment $equipment)
    {
        $stmt = $this->equipmentClass->changeStatus($equipment);

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Equipment Status Changed'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Equipment Status Changed Failed'];
        }

        return redirect()->route('equipment.index')->with($status['status'], $status['msg']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $stmt = $equipment->delete();

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Equipment Deleted Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Equipment Deletion Failed'];
        }

        return redirect()->route('equipment.index')->with($status['status'], $status['msg']);
    }

    public function pagination()
    {
        $allEquipments = Equipment::latest();

        return DataTables::of($allEquipments)
            ->addColumn('sn', function () {
                static $count = 1;
                return $count++;
            })
            ->addColumn('status', function ($row) {
                $icon = ($row->status == '1') ? 'bg-success' : 'bg-danger';
                $value = ($row->status == '1') ? 'Active'  : 'Inactive';
                $html = "<span class='badge $icon'>$value</span>";
                return $html;
            })
            ->addColumn('department', function ($row) {
                return $row->department->name;
            })
            ->addColumn('image', function ($row) {
                $url = asset('storage/' . $row->image);
                $html = "<img src='{$url}' alt='{$row->name}' style='height:80px; width:80;'>";
                return $html;
            })
            ->addColumn('action', function ($row) {
                $html = "<div class='dropdown'>  <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button> <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                <li><a class='dropdown-item' href='equipment/changeStatus/$row->id' ><i class='fa fa-exchange'></i> Change Status</a></li>
                <li><a class='dropdown-item' href='equipment/$row->id' ><i class='fa fa-pencil'></i> Edit</a></li>
                <li><a class='dropdown-item' href='javascript:void(0)' ><i class='fa fa-eye'></i> View</a></li>
                <li><a class='dropdown-item' href='javascript:void(0)' onclick=\"deleteRecord('equipment', $row->id);\"><i class='fa fa-trash'></i> Delete</a></li>
                </ul></div>";

                return $html;
            })
            ->rawColumns(['status','image', 'action'])
            ->toJson();
    }
}
