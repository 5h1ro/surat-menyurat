<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Incoming;
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
        $disposition = Disposition::all();
        $incoming = collect();
        foreach ($disposition as $value) {
            if ($value->fk_staff != null) {
                if ($value->fk_staff == $user->staff->nip && $value->incoming->status_teacher == 0) {
                    $incoming->push($value->incoming);
                }
            }
        }
        $incoming->count = count($incoming);

        $incomings = Disposition::where('fk_staff', $user->staff->nip)->get();
        foreach ($incomings as $value) {
            $date = substr($value->incoming->created_at, 0, 10);
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
            $value->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $value->incoming->letter_date)->isoFormat('DD MMMM Y');
        }
        $data = url('api/staff/surat-masuk/index/get', $user->staff->nip);
        $read = url('staff/surat-masuk/read');
        return view('staff.surat_masuk.index', compact('user', 'data', 'read', 'incoming', 'incomings'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Disposition::where('fk_staff', $id)->get();
            foreach ($data as $value) {
                $value->incoming->number_encrypt = Crypt::encrypt($value->incoming->number);
                $value->incoming->number_md5 = md5($value->incoming->number);
                $value->incoming->admin;
                $date = substr($value->incoming->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->incoming->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Disposition::where('fk_staff', $id)->get();
            foreach ($data as $value) {
                $value->incoming->number_encrypt = Crypt::encrypt($value->incoming->number);
                $value->incoming->number_md5 = md5($value->incoming->number);
                $value->incoming->admin;
                $value->incoming->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function getSearch($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Disposition::where('fk_staff', $id)->get();
            foreach ($data as $value) {
                $value->incoming->number_encrypt = Crypt::encrypt($value->incoming->number);
                $value->incoming->number_md5 = md5($value->incoming->number);
                $value->incoming->admin;
                $date = substr($value->incoming->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->incoming->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Disposition::where('fk_staff', $id)->get();
            foreach ($data as $value) {
                $value->incoming->number_encrypt = Crypt::encrypt($value->incoming->number);
                $value->incoming->number_md5 = md5($value->incoming->number);
                $value->incoming->admin;
                $date = substr($value->incoming->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->incoming->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function read($id)
    {
        $surat = Incoming::find(Crypt::decrypt($id));
        $surat->status_teacher = 1;
        $surat->save();
        return redirect()->to($surat->letter);
    }
}
