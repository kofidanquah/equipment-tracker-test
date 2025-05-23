<?php

namespace App\Http\Controllers;

use App\Classes\WorkerClass;
use App\Http\Requests\WorkerRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WorkerController extends Controller
{
    public $pgdata;
    public $workerClass;

    public function __construct()
    {
        $this->pgdata = [
            'heading' => 'Workers',
            'pg' => 'worker',
        ];

        $this->workerClass = new WorkerClass();
    }
    public function index()
    {
        return view('workers.list', $this->pgdata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->pgdata['roles'] = Role::all();
        return view('workers.new', $this->pgdata);
    }    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkerRequest $request)
    {
        $stmt = $this->workerClass->addWorker( $request->name,$request->email, $request->role);

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Worker Created Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Worker Creation Failed'];
        }

        return redirect()->route('worker.index')->with($status['status'], $status['msg']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        $stmt = $worker->delete();

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Worker Deleted Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Worker Deletion Failed'];
        }

        return redirect()->route('workers.index')->with($status['status'], $status['msg']);
    }

    public function pagination()
    {
        $allWorkers = User::where('id', '!=', Auth::user()->id);

        return DataTables::of($allWorkers)
            ->addColumn('sn', function () {
                static $count = 1;
                return $count++;
            })
            ->addColumn('status', function ($row) {
                $icon = ($row->user_status == '1') ? 'bg-success' : 'bg-danger';
                $value = ($row->user_status == '1') ? 'Active'  : 'Inactive';
                $html = "<span class='badge $icon'>$value</span>";
                return $html;
            })
            ->addColumn('role', function($row){
                return $row->roles->pluck('name')->implode(', ');
            })
            ->addColumn('action', function ($row) {
                $html = "<div class='dropdown'>  <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button> <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                <li><a class='dropdown-item' href='javascript:void(0)' ><i class='fa fa-pencil'></i> Change Status</a></li>
                <li><a class='dropdown-item' href='javascript:void(0)' ><i class='fa fa-eye'></i> View</a></li>
                <li><a class='dropdown-item' href='javascript:void(0)' onclick=\"deleteRecord('worker', $row->id);\"><i class='fa fa-trash'></i> Delete</a></li>
                </ul></div>";

                return $html;
            })
            ->rawColumns(['status', 'action'])
            ->toJson();    }
}
