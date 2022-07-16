<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Fixing;
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
        $id = $user->admin->nip;
        $data = url('api/admin/perbaikan-surat/index/get', $user->admin->nip);
        $acc = url('admin/perbaikan-surat/acc');
        $not_acc = url('admin/perbaikan-surat/not_acc');
        $fixing = Fixing::all();
        foreach ($fixing as $value) {
            $date = substr($value->created_at, 0, 10);
            $student = Student::find($value->fk_student);
            $value->sender = $student->name;
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        $outgoing = Outgoing::all();
        $count = count($outgoing->where('status', 0));
        return view('admin.perbaikan_surat.index', compact('user', 'data', 'acc', 'not_acc', 'outgoing', 'count', 'fixing', 'id'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $admin = Admin::find($id);
            $data = Fixing::all();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $student = Student::find($value->fk_student);
                $value->sender = $student->name;
                $value->admin = $admin->status;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $admin = Admin::find($id);
            $data = Fixing::all();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $student = Student::find($value->fk_student);
                $value->sender = $student->name;
                $value->admin = $admin->status;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function getSearch($detail, $id, Request $request)
    {
        if ($request->ajax()) {
            $admin = Admin::find($id);
            if ($detail == "null") {
                $data = Fixing::all();
            } else {
                $data = Fixing::where('detail', 'like', '%' . $detail . '%')->get();
            }
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $student = Student::find($value->fk_student);
                $value->sender = $student->name;
                $value->admin = $admin->status;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $admin = Admin::find($id);
            if ($detail == "null") {
                $data = Fixing::all();
            } else {
                $data = Fixing::where('detail', 'like', '%' . $detail . '%')->get();
            }
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $student = Student::find($value->fk_student);
                $value->sender = $student->name;
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
        $surat = Fixing::where('id', $id)->first();
        $surat->status = 2;
        $surat->save();
        return redirect()->back();
    }

    public function not_acc($id)
    {
        $surat = Fixing::where('id', $id)->first();
        $surat->status = 1;
        $surat->save();
        return redirect()->back();
    }

    public function upload($id, Request $request)
    {
        $this->validate($request, [
            'letter' => "required|mimes:pdf",
        ], [
            'letter.required' => 'Scan surat tidak boleh kosong',
            'letter.mimes' => 'Scan surat harus berformat pdf',
        ]);
        $now = Carbon::now()->format('dmYHis');
        $filename = $now . '.pdf';
        $file = $request->file('letter');
        $file->move(public_path('assets/report/fixing'), $filename);
        $fixing = Fixing::find($id);
        $fixing->letter = asset('assets/report/fixing/' . $filename);
        $fixing->save();
        return redirect()->back();
    }
}
