<?php

namespace App\Http\Controllers;

use App\Classes\UserClass;
use App\Http\Requests\LoginRequest;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Maintenance_Logs;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $pgdata;
    public $userClass;

    public function __construct(){
        $this->pgdata = [
            'heading' => 'Dashboard',
            'pg' => 'dashboard',
            'equipments' => Equipment::count(),
        ];
        $this->userClass = new UserClass();
    }
    public function index(){
        return view('home.index');
    }

    public function login(LoginRequest $request){
        $stmt = Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_status' => '1']);

        if ($stmt){
            // check if user has changed default password
            $user = Auth::user();
            if ($user->password_status == '0') {
                return redirect()->route('password.change')->with('warning', 'Please change your default password.');
            }

            if($user->hasRole('admin')){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('worker.dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials or inactive account.');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function adminDashboard(){
        $this->pgdata['activeWorkers'] = Worker::count();
        $this->pgdata['departments'] = Department::count();

        return view('admin.dashboard', $this->pgdata);
    }

    public function workerDashboard(){
        $this->pgdata['pendingMaintenance'] = Maintenance_Logs::where('assigned_to', Auth::user()->id)->count();
        return view('worker.dashboard', $this->pgdata);
    }

    public function passwordChange()
    {
        return view('worker.changePassword');
    }
    public function confirmChange(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'user_id' => 'required|integer',
        ]);

        $stmt = $this->userClass->changePassword($request->password, $request->user_id);

        if($stmt){
            return redirect()->route('worker.dashboard');
        }else{
            return redirect()->back()->with('error', 'Password Change Failed');
        }

    }
}
