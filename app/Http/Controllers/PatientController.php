<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medhistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PatientController extends Controller
{
    // public function showAllUsers()
    // {
    //     $data = [
    //         'users' => User::all(),
    //         'page_open' => 'patient_list',
    //         'page_title' => 'Patient List',
    //         'user' => Auth::user(),
    //     ];
    
    //     return view('admin.patient_list', $data);
    // }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['users'] = User::all();
        $data['page_open'] = 'patient_list';
        $data['page_title'] = 'Patient List';
        // $data['user'] = Auth::user();

        return view('admin.patient_list', $data);
    }
    public function profile($id)
    {
        // Fetch the user by ID from the database
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            abort(404);
        }
        $appointments = $user->appointments;
    
        // Fetch the user's medical history
        $medHistory = Medhistory::with('questions')->where('user_id', $id)->get();

        return view('admin.user_record', [
            'user' => $user,
            'medHistory' => $medHistory,
            'appointments' => $appointments,
            'page_open' => 'patient_list',
            'page_title' => 'patient_list'
        ]);
    }
    
}
