<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Superadmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('superadmin.profile.index', compact('user'));
    }

    public function edit($id, Request $request)
    {
        $user = User::find($id);
        $superadmin = Superadmin::where('id_user', $user->id)->first();
        if (isset($request->password)) {
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $superadmin->name = $request->name;
            $superadmin->nip = $request->nip;
        } else {
            $user->email = $request->email;
            $superadmin->name = $request->name;
            $superadmin->nip = $request->nip;
        }
        try {
            $superadmin->save();
            $user->save();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sudah ada akun dengan data tersebut');
        }
    }
}
