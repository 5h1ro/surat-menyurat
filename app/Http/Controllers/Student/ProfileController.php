<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('student.profile.index', compact('user'));
    }

    public function edit($id, Request $request)
    {
        $user = User::find($id);
        $student = Student::where('id_user', $user->id)->first();
        if (isset($request->password)) {
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $student->name = $request->name;
            $student->birthplace = $request->birthplace;
            $student->birthday = $request->birthday;
            $student->class = $request->class;
            $student->nisn = $request->nisn;
            $student->ni = $request->ni;
        } else {
            $user->email = $request->email;
            $student->name = $request->name;
            $student->birthplace = $request->birthplace;
            $student->birthday = $request->birthday;
            $student->class = $request->class;
            $student->nisn = $request->nisn;
            $student->ni = $request->ni;
        }
        try {
            $student->save();
            $user->save();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sudah ada akun dengan data tersebut');
        }
    }
}
