<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Outgoing;
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
        $outgoing = Outgoing::all();
        $count = count($outgoing->where('status', 0));
        return view('admin.profile.index', compact('user', 'count'));
    }

    public function edit($id, Request $request)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => "required",
            'nip' => ['required', 'numeric', Rule::unique('admins')->ignore($user->admin)],
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
        $admin = Admin::where('id_user', $user->id)->first();
        if (isset($request->password)) {
            $this->validate($request, [
                'password' => "min:8",
            ], [
                'password.min' => 'Password minimal 8 karakter',
            ]);
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $admin->name = $request->name;
            $admin->nip = $request->nip;
        } else {
            $user->email = $request->email;
            $admin->name = $request->name;
            $admin->nip = $request->nip;
        }
        try {
            $admin->save();
            $user->save();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sudah ada akun dengan data tersebut');
        }
    }
}
