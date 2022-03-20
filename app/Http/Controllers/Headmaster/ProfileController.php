<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Models\Headmaster;
use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $incoming = Incoming::where([['id_headmaster', '=', $user->headmaster->id], ['status', '=', 0]])->get();
        $incoming->count = count($incoming);
        $outgoing = Outgoing::where('status', '>=', 2)->get();
        $outgoing->count = count($outgoing->where('status', 2));
        return view('headmaster.profile.index', compact('user', 'incoming', 'outgoing'));
    }

    public function edit($id, Request $request)
    {
        $user = User::find($id);
        $headmaster = Headmaster::where('id_user', $user->id)->first();
        if (isset($request->password)) {
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $headmaster->name = $request->name;
            $headmaster->nip = $request->nip;
        } else {
            $user->email = $request->email;
            $headmaster->name = $request->name;
            $headmaster->nip = $request->nip;
        }
        try {
            $headmaster->save();
            $user->save();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sudah ada akun dengan data tersebut');
        }
    }
}