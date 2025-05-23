<?php

namespace App\Http\Controllers;

use App\Classes\MaintenanceClass;
use App\Http\Requests\MaintenanceRequest;
use App\Models\Equipment;
use App\Models\Maintenance_Logs;
use App\Models\User;
use App\Models\Worker;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaintenanceLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $pgdata;
    public $maintenanceClass;
    public function __construct()
    {
        $this->pgdata = [
            'heading' => 'Maintenance',
            'pg' => 'maintenance',
        ];

        $this->maintenanceClass = new MaintenanceClass;
    }
    public function index()
    {
        return view('maintenance.list', $this->pgdata);
    }
    public function myMaintenance()
    {
        return view('maintenance.my-maintenance', $this->pgdata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->pgdata['allEquipments'] = Equipment::where('status', '=', '1')->get();
        $this->pgdata['allWorkers'] = User::where('user_status', '=', '1')->get();

        return view('maintenance.new', $this->pgdata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaintenanceRequest $request)
    {
        $stmt = $this->maintenanceClass->assignto($request->equipment, $request->worker, $request->maintenance_date, $request->note);

        $status = [];
        if ($stmt) {
            $status = ['status' => 'success', 'msg' => 'Maintenance Assigned Successfully'];
        } else {
            $status = ['status' => 'error', 'msg' => 'Failed to assign maintenance'];
        }

        return redirect()->route('maintenance.index')->with($status['status'], $status['msg']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Maintenance_Logs $maintenance_Logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance_Logs $maintenance_Logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance_Logs $maintenance_Logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance_Logs $maintenance_Logs)
    {
        //
    }

    public function pagination()
    {
        if (Auth::user()->hasRole('admin')) {
            $allMaintenance = Maintenance_Logs::latest();
        } else {
            $allMaintenance = Maintenance_Logs::latest()->where('assigned_to', Auth::user()->id);
        }

        return DataTables::of($allMaintenance)
            ->addColumn('sn', function () {
                static $count = 1;
                return $count++;
            })
            ->addColumn('status', function ($row) {
                $icon = ($row->status == '1') ? 'bg-success' : 'bg-danger';
                $value = ($row->status == '1') ? 'Completed'  : 'Pending';
                $html = "<span class='badge $icon'>$value</span>";
                return $html;
            })
            ->addColumn('equipment', function ($row) {
                return $row->equipment->name;
            })
            ->addColumn('assigned_to', function ($row) {
                return $row->worker->name;
            })
            ->addColumn('maintenance_date', function ($row) {
                return Carbon::parse($row->maintenance_date)->format('j F, Y');
            })
            ->addColumn('next_maintenance', function ($row) {
                return $row->next_maintenance ? Carbon::parse($row->next_maintenance)->format('j F, Y') : '-';
            })
            ->addColumn('action', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    $html = "<div class='dropdown'>  <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button> <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                    <li><a class='dropdown-item' href='javascript:void(0)'><i class='fa fa-pencil'></i> Edit</a></li>
                    <li><a class='dropdown-item' href='javascript:void(0)' onclick=\"deleteRecord('role', $row->id);\"><i class='fa fa-trash'></i> Delete</a></li>
                    </ul></div>";
                } else {
                    $html = "<div class='dropdown'>  <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button> <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                    <li><a class='dropdown-item record-btn' href='javascript:void(0)' data-id='{$row->id}'><i class='fa fa-pencil'></i> Record</a></li>
                    <li><a class='dropdown-item' href='javascript:void(0)'><i class='fa fa-eye'></i> View</a></li>
                    </ul></div>";
                }

                return $html;
            })
            ->rawColumns(['status', 'action'])
            ->toJson();
    }

    public function getData($id)
    {
        // Find the maintenance log with related equipment data
        $log = Maintenance_Logs::with('equipment')->findOrFail($id);

        // Return the required data as JSON
        return response()->json([
            'equipment_name' => $log->equipment->name,
            'maintenance_date' => $log->maintenance_date,
            'next_maintenance' => $log->next_maintenance ?? '',
            'notes' => $log->notes ?? '',
            'id' => $log->id,
        ]);
    }

    public function storeRecord(Request $request)
    {
        $request->validate([
            'next_maintenance_date' => 'nullable|date',
            'status' => 'required|integer',
            'remarks' => 'nullable|string',
            'id' => 'required|integer',
        ]);

        $log = Maintenance_Logs::findOrFail($request->id);
        $log->next_maintenance = $request->next_maintenance_date;
        $log->status = $request->status;
        $log->remarks = $request->remarks;
        $log->save();

        return redirect()->back()->with('success', 'Maintenance recorded successfully.');
    }
}
