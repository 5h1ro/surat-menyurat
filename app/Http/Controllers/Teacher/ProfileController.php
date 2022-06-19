<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Teacher;
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
        $disposition = Disposition::all();
        $incoming = collect();
        foreach ($disposition as $value) {
            if ($value->fk_teacher != null) {
                if ($value->fk_teacher == $user->teacher->nip && $value->incoming->status_teacher == 0) {
                    $incoming->push($value->incoming);
                }
            }
        }
        $incoming->count = count($incoming);
        return view('teacher.profile.index', compact('user', 'incoming'));
    }

    public function edit($id, Request $request)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => "required",
            'nip' => ['required', 'numeric', Rule::unique('teachers')->ignore($user->teacher)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.numeric' => 'NIP hanya boleh diisi angka tanpa spasi',
            'nip.unique' => 'NIP sudah ada dengan akun lain',
            'email.required' => 'Email tidak boleh kosong',
            'email.numeric' => 'Email hanya boleh diisi dengan format email',
            'email.unique' => 'Email sudah ada dengan akun lain',
        ]);
        $teacher = $user->teacher;
        if (isset($request->password)) {
            $this->validate($request, [
                'password' => "min:8|confirmed",
            ], [
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password yang anda masukkan tidak sama',
            ]);
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $teacher->name = $request->name;
            $teacher->nip = $request->nip;
        } else {
            $user->email = $request->email;
            $teacher->name = $request->name;
            $teacher->nip = $request->nip;
        }
        try {
            $teacher->save();
            $user->save();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sudah ada akun dengan data tersebut');
        }
    }
}
