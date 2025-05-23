<?php

namespace App\Http\Controllers;

use App\Classes\DepartmentClass;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public $pgdata;
    public $deptClass;

    public function __construct()
    {
        $this->pgdata = [
            'heading' => 'Department',
            'pg' => 'department',
        ];

        $this->deptClass = new DepartmentClass();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('departments.list', $this->pgdata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string|unique:departments,name'
        ]);

        $stmt = $this->deptClass->addDepartment($request->department);

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Department Created Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Department Creation Failed'];
        }

        return redirect()->route('department.index')->with($status['status'], $status['msg']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $stmt = $department->delete();

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Department Deleted Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Department Deletion Failed'];
        }

        return redirect()->route('department.index')->with($status['status'], $status['msg']);
    }

    public function pagination()
    {
        $allDepartments = Department::all();

        return DataTables::of($allDepartments)
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
            ->addColumn('action', function ($row) {
                $html = "<div class='dropdown'>  <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button> <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                <li><a class='dropdown-item' href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#updateDepartment' onclick='editDepartment({{ json_encode($row) }})'><i class='fa fa-pencil'></i> Edit</a></li>
                <li><a class='dropdown-item' href='javascript:void(0)' onclick=\"deleteRecord('department', $row->id);\"><i class='fa fa-trash'></i> Delete</a></li>
                </ul></div>";

                return $html;
            })
            ->rawColumns(['status', 'action'])
            ->toJson();
    }
}
