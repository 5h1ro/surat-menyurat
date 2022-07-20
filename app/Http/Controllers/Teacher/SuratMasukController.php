<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Incoming;
use App\Models\User;
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
            if ($value->fk_teacher != null) {
                if ($value->fk_teacher == $user->teacher->nip && $value->incoming->status_teacher == 0) {
                    $incoming->push($value->incoming);
                }
            }
        }
        $incoming->count = count($incoming);

        $incomings = $user->teacher->disposition;
        foreach ($incomings as $value) {
            $date = substr($value->incoming->created_at, 0, 10);
            $value->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $value->incoming->letter_date)->isoFormat('DD MMMM Y');
        }
        $data = url('api/teacher/surat-masuk/index/get', $user->teacher->nip);
        $read = url('teacher/surat-masuk/read');
        return view('teacher.surat_masuk.index', compact('user', 'data', 'read', 'incoming', 'incomings'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Disposition::where('fk_teacher', $id)->get();
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
            $data = Disposition::where('fk_teacher', $id)->get();
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

    public function read($id)
    {
        $surat = Incoming::find(Crypt::decrypt($id));
        $surat->status_teacher = 1;
        $surat->save();
        return redirect()->to($surat->letter);
    }
}
