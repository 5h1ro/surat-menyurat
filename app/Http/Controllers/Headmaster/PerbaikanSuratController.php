<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Models\Fixing;
use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PerbaikanSuratController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $incoming = Incoming::where([['fk_headmaster', '=', $user->headmaster->nip], ['status', '=', 0]])->get();
        $incoming->count = count($incoming);
        $data = url('api/headmaster/perbaikan-surat/index/get');
        $acc = url('headmaster/perbaikan-surat/acc');
        $not_acc = url('headmaster/perbaikan-surat/not_acc');
        $fixing = Fixing::where('status', '>=', 2)->get();
        foreach ($fixing as $value) {
            $date = substr($value->created_at, 0, 10);
            $student = Student::find($value->fk_student);
            $value->sender = $student->name;
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        $outgoing = Outgoing::all();
        $outgoing->count = count($outgoing->where('status', 2));
        return view('headmaster.perbaikan_surat.index', compact('user', 'data', 'acc', 'not_acc', 'outgoing', 'incoming', 'fixing'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Fixing::where('status', '>=', 2)->get();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $student = Student::find($value->fk_student);
                $value->sender = $student->name;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Fixing::where('status', '>=', 2)->get();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $student = Student::find($value->fk_student);
                $value->sender = $student->name;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function acc($id)
    {
        $surat = Fixing::where('id', $id)->first();
        $surat->status = 3;
        $surat->save();
        return redirect()->back();
    }

    public function not_acc($id)
    {
        $surat = Fixing::where('id', $id)->first();
        $surat->status = 4;
        $surat->save();
        return redirect()->back();
    }
}
