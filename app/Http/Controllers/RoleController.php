<?php

namespace App\Http\Controllers;

use App\Classes\RoleClass;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $pgdata;
    public $roleClass;

    public function __construct()
    {
        $this->pgdata = [
            'heading' => 'Roles',
            'pg' => 'role',
        ];

        $this->roleClass = new RoleClass();
    }
    public function index()
    {
        return view('roles.list', $this->pgdata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.new', $this->pgdata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $stmt = $this->roleClass->addRole($request->role, $request->description);

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Role Created Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Role Creation Failed'];
        }

        return redirect()->route('role.index')->with($status['status'], $status['msg']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $stmt = $role->delete();

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Role Deleted Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Role Deletion Failed'];
        }

        return redirect()->route('role.index')->with($status['status'], $status['msg']);
    }

    public function pagination()
    {
        $allRoles = Role::all();

        return DataTables::of($allRoles)
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
            ->addColumn('description', function($row){
                return $row->description == '' ? 'N/A' : $row->description;
            })
            ->addColumn('action', function ($row) {
                $html = "<div class='dropdown'>  <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button> <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                <li><a class='dropdown-item' href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#updateRole' onclick='editRole({{ json_encode($row) }})'><i class='fa fa-pencil'></i> Edit</a></li>
                <li><a class='dropdown-item' href='javascript:void(0)' onclick=\"deleteRecord('role', $row->id);\"><i class='fa fa-trash'></i> Delete</a></li>
                </ul></div>";

                return $html;
            })
            ->rawColumns(['status', 'action'])
            ->toJson();
    }
}
