<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DataUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = url('api/superadmin/datauser/index/get');
        $list_user = User::all();
        return view('superadmin.datauser.index', compact('user', 'data', 'list_user'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            foreach ($data as $value) {
                $value->responsive_id = "";
            }
            return DataTables::of($data)->make(true);
        } else {
            $data = User::all();
            foreach ($data as $value) {
                $value->responsive_id = "";
            }
            return DataTables::of($data)->make(true);
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // $user = User::all();
        $request->validate([
            'email' => "required",
            'id_role' => "required",
            'password' => "required"
        ]);
        // [
        //     'email.required' => 'Email tidak boleh kosong',
        //     'email.unique' => 'Email telah terdaftar',
        //     'id_role.required' => 'Role tidak boleh kosong',
        //     'password.required' => 'Password tidak boleh kosong',
        //     'password_confirmation.required' => 'Password konfirmasi tidak boleh kosong'
        // ]);

        // dd($request->all());
        $data = [
            '_token' => $request->_token,
            'email' => $request->email,
            'id_role' => $request->id_role,
            'password' => $request->password,

        ];
        // dd($data);
        if (User::create($data)) {
            echo 'berhasi';
        }
        // return (redirect())->route('superadmin.datauser.index');
    }
}
