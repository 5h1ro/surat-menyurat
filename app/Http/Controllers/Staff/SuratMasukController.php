<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Incoming;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SuratMasukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $disposition = Disposition::all();
        $incoming = collect();
        foreach ($disposition as $value) {
            if ($value->id_staff != null) {
                if ($value->id_staff == $user->staff->id && $value->incoming->status_teacher == 0) {
                    $incoming->push($value->incoming);
                }
            }
        }
        $incoming->count = count($incoming);

        $incomings = Disposition::where('id_staff', $user->staff->id)->get();
        foreach ($incomings as $value) {
            $date = substr($value->incoming->created_at, 0, 10);
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
            $value->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $value->incoming->letter_date)->isoFormat('DD MMMM Y');
        }
        $data = url('api/staff/surat-masuk/index/get', $user->staff->id);
        $read = url('staff/surat-masuk/read');
        return view('staff.surat_masuk.index', compact('user', 'data', 'read', 'incoming', 'incomings'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Disposition::where('id_staff', $id)->get();
            foreach ($data as $value) {
                $value->incoming->admin;
                $date = substr($value->incoming->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->incoming->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Disposition::where('id_teacher', $id)->get();
            foreach ($data as $value) {
                $value->incoming->admin;
                $value->incoming->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function read($id)
    {
        $surat = Incoming::where('id', $id)->first();
        $surat->status_teacher = 1;
        $surat->save();
        return redirect()->to($surat->letter);
    }
}
