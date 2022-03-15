<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Outgoing;
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
        $data = url('api/admin/surat-keluar/index/get', $user->admin->id);
        $acc = url('admin/surat-keluar/acc');
        $not_acc = url('admin/surat-keluar/not_acc');
        $outgoing = Outgoing::all();
        foreach ($outgoing as $value) {
            $date = substr($value->created_at, 0, 10);
            if ($value->id_teacher != null) {
                $teacher = Teacher::find($value->id_teacher);
                $value->sender = $teacher->name;
            } else {
                $student = Student::find($value->id_student);
                $value->sender = $student->name;
            }
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        $count = count($outgoing->where('status', 0));
        return view('admin.surat_keluar.index', compact('user', 'data', 'acc', 'not_acc', 'outgoing', 'count'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $admin = Admin::find($id);
            $data = Outgoing::all();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                if ($value->id_teacher != null) {
                    $teacher = Teacher::find($value->id_teacher);
                    $value->sender = $teacher->name;
                } else {
                    $student = Student::find($value->id_student);
                    $value->sender = $student->name;
                }
                $value->admin = $admin->status;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $admin = Admin::find($id);
            $data = Outgoing::all();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                if ($value->id_teacher != null) {
                    $teacher = Teacher::find($value->id_teacher);
                    $value->sender = $teacher->name;
                } else {
                    $student = Student::find($value->id_student);
                    $value->sender = $student->name;
                }
                $value->admin = $admin->status;
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
        $surat->status = 2;
        $surat->save();
        return redirect()->back();
    }

    public function not_acc($id)
    {
        $surat = Outgoing::where('id', $id)->first();
        $surat->status = 1;
        $surat->save();
        return redirect()->back();
    }

    public function upload($id, Request $request)
    {
        $now = Carbon::now()->format('dmYHis');
        $filename = $now . '.pdf';
        $file = $request->file('letter');
        $file->move(public_path('assets/report/outgoing'), $filename);
        $outgoing = Outgoing::find($id);
        $outgoing->letter = asset('assets/report/outgoing/' . $filename);
        $outgoing->save();
        return redirect()->back();
    }
}
