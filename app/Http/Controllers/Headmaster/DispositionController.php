<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DispositionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $incoming = Incoming::where([['fk_headmaster', '=', $user->headmaster->nip], ['status', '=', 0]])->get();
        $incoming->count = count($incoming);
        $data = url('api/headmaster/disposisi/index/get', $user->headmaster->nip);
        $read = url('headmaster/disposisi/read');
        $acc = url('headmaster/disposisi/acc');
        $not_acc = url('headmaster/disposisi/not_acc');
        $disposition = Disposition::all();
        $teacher = Teacher::all();
        $staff = Staff::all();
        $stafftype = StaffType::all();
        $outgoing = Outgoing::where('status', '>=', 2)->get();
        $outgoing->count = count($outgoing->where('status', 2));
        return view('headmaster.disposisi.index', compact('user', 'data', 'read', 'incoming', 'acc', 'not_acc', 'disposition', 'teacher', 'outgoing', 'staff', 'stafftype'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Disposition::all()->unique('fk_incoming');
            foreach ($data as $value) {
                $dispositions = Disposition::where('fk_incoming', $value->fk_incoming)->get();
                if ($value->fk_teacher != null) {
                    $value->teachers = "";
                    $value->staffs = "";
                    foreach ($dispositions as $values) {
                        if ($values->fk_teacher != null) {
                            $name = Teacher::where('nip', $values->fk_teacher)->first();
                            $value->teachers = $value->teachers . $name->name . ', ';
                        }
                        if ($values->fk_staff != null) {
                            if ($values->fk_staff != null) {
                                $name_staff = Staff::where('nip', $values->fk_staff)->first();
                                $value->staffs = $value->staffs . $name_staff->name . ', ';
                            }
                        }
                    }
                    $value->staffs = substr($value->staffs, 0, -2);
                    if ($value->staffs == "") {
                        $value->staffs = "Belum Diteruskan";
                    }
                    $value->teachers = substr($value->teachers, 0, -2);
                } else {
                    if ($value->fk_staff != null) {
                        $value->staffs = "";
                        foreach ($dispositions as $values) {
                            $name = Staff::where('nip', $values->fk_staff)->first();
                            $value->staffs = $value->staffs . $name->name . ', ';
                        }
                        $value->staffs = substr($value->staffs, 0, -2);
                    }
                }
                $value->incoming;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Disposition::all()->unique('fk_incoming');
            foreach ($data as $value) {
                $dispositions = Disposition::where('fk_incoming', $value->fk_incoming)->get();
                if ($value->fk_teacher != null) {
                    $value->teachers = "";
                    $value->staffs = "";
                    foreach ($dispositions as $values) {
                        if ($values->fk_teacher != null) {
                            $name = Teacher::where('nip', $values->fk_teacher)->first();
                            $value->teachers = $value->teachers . $name->name . ', ';
                        }
                        if ($values->fk_staff != null) {
                            if ($values->fk_staff != null) {
                                $name_staff = Staff::where('nip', $values->fk_staff)->first();
                                $value->staffs = $value->staffs . $name_staff->name . ', ';
                            }
                        }
                    }
                    $value->staffs = substr($value->staffs, 0, -2);
                    if ($value->staffs == "") {
                        $value->staffs = "Belum Diteruskan";
                    }
                    $value->teachers = substr($value->teachers, 0, -2);
                } else {
                    if ($value->fk_staff != null) {
                        $value->staffs = "";
                        foreach ($dispositions as $values) {
                            $name = Staff::where('nip', $values->fk_staff)->first();
                            $value->staffs = $value->staffs . $name->name . ', ';
                        }
                        $value->staffs = substr($value->staffs, 0, -2);
                    }
                }
                $value->incoming;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function read($id)
    {
        $surat = Disposition::where('id', $id)->first();
        return redirect()->to($surat->letter);
    }

    public function acc($id)
    {
        $surat = Disposition::where('id', $id)->first();
        $surat->status = 1;
        $surat->save();
        $this->readable($surat->fk_incoming);
        return redirect()->back();
    }

    public function not_acc($id)
    {
        $surat = Disposition::where('id', $id)->first();
        $surat->status = 2;
        $surat->save();
        $this->readable($surat->fk_incoming);
        return redirect()->back();
    }

    public function edit($id, Request $request)
    {
        $now = Carbon::now()->format('dmYHis');
        $filename = $now . '.pdf';
        if ($request->fk_teacher == null && $request->fk_stafftype == null) {
            $this->validate($request, [
                'fk_teacher' => "required",
                'fk_stafftype' => "required",
            ], [
                'fk_teacher.required' => 'Guru tidak boleh kosong',
                'fk_stafftype.required' => 'Bidang tidak boleh kosong',
            ]);
        }
        if (isset($request->fk_teacher)) {
            if (count($request->fk_teacher) == 1) {
                foreach ($request->fk_teacher as $value) {
                    $surat = Disposition::where('id', $id)->first();
                    $surat_all = Disposition::where('id', $id)->get();
                    $teacher = Teacher::where('nip', $value)->first();
                    $name = $teacher->name;
                    if (isset($request->fk_stafftype)) {
                        $name = $name . ', ';
                        foreach ($surat_all as $datas) {
                            if ($datas->fk_staff != null) {
                                $staffs = Staff::where('nip', $datas->fk_staff)->first();
                                $name = $name . $staffs->name . ', ';
                            }
                        }
                    }
                    // $surat->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $surat->incoming->letter_date)->isoFormat('DD MMMM Y');
                    $date = Carbon::createFromFormat('Y-m-d', substr($surat->incoming->created_at, 0, 10))->isoFormat('DD MMMM Y');
                    $pdf = Pdf::loadview('report.disposisi_edit', compact('surat', 'date', 'name', 'request'))->setPaper('a4', 'portrait');
                    $pdf->save(public_path('assets/report/disposition/')  . $filename);
                    $surat->fk_teacher = $value;
                    $surat->letter = asset('assets/report/disposition/' . $filename);
                    $surat->instruction = $request->instruction;
                    $surat->status = 1;
                    $surat->save();
                    $this->readable($surat->fk_incoming);
                }
                if (isset($request->fk_stafftype)) {
                    for ($i = 0; $i < count($request->fk_stafftype); $i++) {
                        $staff_disposition = Staff::where('fk_type', $request->fk_stafftype[$i])->first();
                        $surat_first = Disposition::where('id', $id)->first();
                        if (Disposition::where('fk_staff', $request->fk_stafftype[$i])->first() == null) {
                            $id = IdGenerator::generate(['table' => 'dispositions', 'length' => 8, 'prefix' => 'DP-']);
                            $surat = new Disposition;
                            $surat->id = $id;
                            $surat->fk_incoming = $surat_first->fk_incoming;
                            $surat->fk_staff = $staff_disposition->nip;
                            $surat->letter = $surat_first->letter;
                            $surat->instruction = $surat_first->instruction;
                            $surat->status = $surat_first->status;
                            $surat->information = $surat_first->information;
                            $surat->save();
                        }
                    }
                } else {
                    $surat->save();
                    $this->readable($surat->fk_incoming);
                }
            } else {
                for ($i = 0; $i < count($request->fk_teacher); $i++) {
                    if ($i == 0) {
                        $surat = Disposition::where('id', $id)->first();
                        $name = "";
                        foreach ($request->fk_teacher as $datas) {
                            $teachers = Teacher::where('nip', $datas)->first();
                            $name = $name . $teachers->name . ', ';
                        }
                        if (isset($request->fk_stafftype)) {
                            foreach ($request->fk_stafftype as $datas) {
                                $staffs = Staff::where('fk_type', $datas)->first();
                                $name = $name . $staffs->name . ', ';
                            }
                        }
                        $name = substr($name, 0, -2);
                        // $surat->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $surat->incoming->letter_date)->isoFormat('DD MMMM Y');
                        $date = Carbon::createFromFormat('Y-m-d', substr($surat->incoming->created_at, 0, 10))->isoFormat('DD MMMM Y');
                        $pdf = Pdf::loadview('report.disposisi_edit', compact('surat', 'date', 'name', 'request'))->setPaper('a4', 'portrait');
                        $pdf->save(public_path('assets/report/disposition/')  . $filename);
                        $surat->fk_teacher = $request->fk_teacher[$i];
                        $surat->letter = asset('assets/report/disposition/' . $filename);
                        $surat->instruction = $request->instruction;
                        $surat->status = 1;
                        $surat->save();
                        $this->readable($surat->fk_incoming);
                    } else {
                        $surat_first = Disposition::where('id', $id)->first();
                        $id = IdGenerator::generate(['table' => 'dispositions', 'length' => 8, 'prefix' => 'DP-']);
                        $surat = new Disposition;
                        $surat->id = $id;
                        $surat->fk_incoming = $surat_first->fk_incoming;
                        $surat->fk_teacher = $request->fk_teacher[$i];
                        $surat->letter = $surat_first->letter;
                        $surat->instruction = $surat_first->instruction;
                        $surat->status = $surat_first->status;
                        $surat->information = $surat_first->information;
                        $surat->save();
                        $this->readable($surat->fk_incoming);
                    }
                }
                if (isset($request->fk_stafftype)) {
                    for ($i = 0; $i < count($request->fk_stafftype); $i++) {
                        $staff_disposition = Staff::where('fk_type', $request->fk_stafftype[$i])->first();
                        $surat_first = Disposition::where('id', $id)->first();
                        $id = IdGenerator::generate(['table' => 'dispositions', 'length' => 8, 'prefix' => 'DP-']);
                        $surat = new Disposition;
                        $surat->id = $id;
                        $surat->fk_incoming = $surat_first->fk_incoming;
                        $surat->fk_staff = $staff_disposition->nip;
                        $surat->letter = $surat_first->letter;
                        $surat->instruction = $surat_first->instruction;
                        $surat->status = $surat_first->status;
                        $surat->information = $surat_first->information;
                        $surat->save();
                    }
                } else {
                    $surat->save();
                    $this->readable($surat->fk_incoming);
                }
            }
        } else {
            if (count($request->fk_stafftype) == 1) {
                foreach ($request->fk_stafftype as $value) {
                    $surat = Disposition::where('id', $id)->first();
                    $staff = Staff::where('fk_type', $value)->first();
                    $name = $staff->name;
                    // $surat->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $surat->incoming->letter_date)->isoFormat('DD MMMM Y');
                    $date = Carbon::createFromFormat('Y-m-d', substr($surat->incoming->created_at, 0, 10))->isoFormat('DD MMMM Y');
                    $pdf = Pdf::loadview('report.disposisi_edit', compact('surat', 'date', 'name', 'request'))->setPaper('a4', 'portrait');
                    $pdf->save(public_path('assets/report/disposition/')  . $filename);
                    $staff_disposition = Staff::where('fk_type', $value)->first();
                    $surat->fk_staff = $staff_disposition->nip;
                    $surat->letter = asset('assets/report/disposition/' . $filename);
                    $surat->instruction = $request->instruction;
                    $surat->status = 1;
                    $surat->save();
                    $this->readable($surat->fk_incoming);
                }
            } else {
                for ($i = 0; $i < count($request->fk_stafftype); $i++) {
                    if ($i == 0) {
                        $surat = Disposition::where('id', $id)->first();
                        $name = "";
                        foreach ($request->fk_stafftype as $datas) {
                            $staffs = Staff::where('fk_type', $datas)->first();
                            $name = $name . $staffs->name . ', ';
                        }
                        $name = substr($name, 0, -2);
                        $staff_disposition = Staff::where('fk_type', $request->fk_stafftype)->first();
                        // $surat->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $surat->incoming->letter_date)->isoFormat('DD MMMM Y');
                        $date = Carbon::createFromFormat('Y-m-d', substr($surat->incoming->created_at, 0, 10))->isoFormat('DD MMMM Y');
                        $pdf = Pdf::loadview('report.disposisi_edit', compact('surat', 'date', 'name', 'request'))->setPaper('a4', 'portrait');
                        $pdf->save(public_path('assets/report/disposition/')  . $filename);
                        $surat->fk_staff = $staff_disposition->nip;
                        $surat->letter = asset('assets/report/disposition/' . $filename);
                        $surat->instruction = $request->instruction;
                        $surat->status = 1;
                        $surat->save();
                        $this->readable($surat->fk_incoming);
                    } else {
                        $surat_first = Disposition::where('id', $id)->first();
                        $surat = new Disposition;
                        $staff_disposition = Staff::where('fk_type', $request->fk_stafftype)->first();
                        $surat->fk_incoming = $surat_first->fk_incoming;
                        $surat->fk_staff = $staff_disposition->nip;
                        $surat->letter = $surat_first->letter;
                        $surat->instruction = $surat_first->instruction;
                        $surat->status = $surat_first->status;
                        $surat->information = $surat_first->information;
                        $surat->save();
                    }
                }
            }
        }
        $disposition_surat = Disposition::where('id', $id)->get();
        $surat_first = Disposition::where('id', $id)->first();
        $surat_all = Disposition::where('fk_incoming', $surat_first->fk_incoming)->get();
        foreach ($disposition_surat as $key => $value) {
            $name = '';
            foreach ($surat_all as $datas) {
                if ($datas->fk_staff != null && $datas->fk_teacher != null) {
                    $staffs = Staff::where('nip', $datas->fk_staff)->first();
                    $name = $name . $staffs->name . ', ';
                    $teacher = Teacher::where('nip', $datas->fk_teacher)->first();
                    $name = $name . $teacher->name . ', ';
                } else {
                    if ($datas->fk_staff != null) {
                        $staffs = Staff::where('nip', $datas->fk_staff)->first();
                        $name = $name . $staffs->name . ', ';
                    } else {
                        $teacher = Teacher::where('nip', $datas->fk_teacher)->first();
                        $name = $name . $teacher->name . ', ';
                    }
                }
            }
        }
        foreach ($surat_all as $key => $surat) {
            // $surat->incoming->letter_date = Carbon::createFromFormat('Y-m-d', $surat->incoming->letter_date)->isoFormat('DD MMMM Y');
            $date = Carbon::createFromFormat('Y-m-d', substr($surat->incoming->created_at, 0, 10))->isoFormat('DD MMMM Y');
            $pdf = Pdf::loadview('report.disposisi_edit', compact('surat', 'date', 'name', 'request'))->setPaper('a4', 'portrait');
            $pdf->save(public_path('assets/report/disposition/')  . $filename);
            $surat->letter = asset('assets/report/disposition/' . $filename);
            $surat->save();
        }
        return redirect()->back();
    }

    public function readable($id)
    {
        $incoming = Incoming::find($id);
        if ($incoming->status == 0) {
            $incoming->status = 1;
            $incoming->save();
        }
    }
}
