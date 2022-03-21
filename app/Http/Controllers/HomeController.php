<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role->name;
        if ($role == "Teacher") {
            return redirect()->route('teacher');
        } else if ($role == "Headmaster") {
            return redirect()->route('headmaster');
        } else if ($role == "Admin") {
            return redirect()->route('admin');
        } else if ($role == "Student") {
            return redirect()->route('student');
        } else if ($role == "Superadmin") {
            return redirect()->route('superadmin');
        } else if ($role == "Staff") {
            return redirect()->route('staff');
        } else {
            return redirect()->to('logout');
        }
    }
}
