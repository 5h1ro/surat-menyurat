<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class SuratMasukController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $incoming = Incoming::where([['fk_headmaster', '=', $user->headmaster->nip], ['status', '=', 0]])->get();
        $incoming->count = count($incoming);
        $data = url('api/headmaster/surat-masuk/index/get', $user->headmaster->nip);
        $read = url('headmaster/surat-masuk/read');
        $teacher = Teacher::all();
        $incomings = $user->headmaster->incoming;
        $outgoing = Outgoing::where('status', '>=', 2)->get();
        $outgoing->count = count($outgoing->where('status', 2));
        return view('headmaster.surat_masuk.index', compact('user', 'data', 'read', 'incoming', 'teacher', 'incomings', 'outgoing'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Incoming::limit(10);
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Incoming::limit(10);
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function read($id)
    {
        $surat = Incoming::find(Crypt::decrypt($id));
        if ($surat->status == 0) {
            $surat->status = 1;
            $surat->save();
        }
        return redirect()->to($surat->letter);
    }
}
