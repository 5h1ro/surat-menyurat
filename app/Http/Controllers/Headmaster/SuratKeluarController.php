<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $incoming = Incoming::where([['fk_headmaster', '=', $user->headmaster->nip], ['status', '=', 0]])->get();
        $incoming->count = count($incoming);
        $data = url('api/headmaster/surat-keluar/index/get');
        $acc = url('headmaster/surat-keluar/acc');
        $not_acc = url('headmaster/surat-keluar/not_acc');
        $outgoing = Outgoing::where('status', '>=', 2)->get();
        foreach ($outgoing as $value) {
            $date = substr($value->created_at, 0, 10);
            if ($value->fk_teacher != null) {
                $teacher = Teacher::find($value->fk_teacher);
                $value->sender = $teacher->name;
            } else {
                $staff = Staff::find($value->fk_staff);
                $value->sender = $staff->name;
            }
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        $outgoing->count = count($outgoing->where('status', 2));
        return view('headmaster.surat_keluar.index', compact('user', 'data', 'acc', 'not_acc', 'outgoing', 'incoming'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Outgoing::where('status', '>=', 2)->get();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                if ($value->fk_teacher != null) {
                    $teacher = Teacher::find($value->fk_teacher);
                    $value->sender = $teacher->name;
                } else {
                    $staff = Staff::find($value->fk_staff);
                    $value->sender = $staff->name;
                }
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Outgoing::where('status', '>=', 2)->get();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                if ($value->fk_teacher != null) {
                    $teacher = Teacher::find($value->fk_teacher);
                    $value->sender = $teacher->name;
                } else {
                    $staff = Staff::find($value->fk_staff);
                    $value->sender = $staff->name;
                }
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function acc($id)
    {
        $surat = Outgoing::where('id', $id)->first();
        $surat->status = 3;
        $surat->save();
        return redirect()->back();
    }

    public function not_acc($id)
    {
        $surat = Outgoing::where('id', $id)->first();
        $surat->status = 4;
        $surat->save();
        return redirect()->back();
    }
}
