<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $this->validate($request, [
            'name' => "required",
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'birthplace' => "required",
            'birthday' => "required|before:today",
            'class' => "required",
            'ni' => "required|numeric",
            'nisn' => "required|numeric",
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.numeric' => 'Email hanya boleh diisi dengan format email',
            'email.unique' => 'Email sudah ada dengan akun lain',
            'birthplace.required' => 'Tempat lahir boleh kosong',
            'birthday.required' => 'Tanggal lahir boleh kosong',
            'birthday.before' => 'Tanggal lahir harus kurang dari sekarang',
            'class.required' => 'Kelas tidak boleh kosong',
            'ni.required' => 'Nomor induk boleh kosong',
            'ni.before' => 'Nomor induk harus berformat angka',
            'nisn.required' => 'NISN boleh kosong',
            'nisn.before' => 'NISN harus berformat angka',
        ]);
        $student = $user->student;
        if (isset($request->password)) {
            $this->validate($request, [
                'password' => "min:8",
            ], [
                'password.min' => 'Password minimal 8 karakter',
            ]);
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
