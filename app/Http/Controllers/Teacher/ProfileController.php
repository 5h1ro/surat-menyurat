<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $disposition = Disposition::all();
        $incoming = collect();
        foreach ($disposition as $value) {
            if ($value->id_teacher != null) {
                if ($value->id_teacher == $user->teacher->id && $value->incoming->status_teacher == 0) {
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
        $teacher = Teacher::where('id_user', $user->id)->first();
        if (isset($request->password)) {
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
