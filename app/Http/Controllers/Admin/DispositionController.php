<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Headmaster;
use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\OutgoingType;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DispositionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = url('api/admin/disposisi/index/get');
        $read = url('admin/disposisi/read');
        $delete = url('admin/disposisi/delete');
        $role = Role::where([['id', '<=', 2]])->get();
        $type = OutgoingType::all();
        $headmaster = Headmaster::all();
        $teacher = Teacher::all();
        $outgoing = Outgoing::all();
        $count = count($outgoing->where('status', 0));
        $disposition = Disposition::all();
        return view('admin.disposition.index', compact('user', 'data', 'read', 'role', 'type', 'headmaster', 'teacher', 'delete', 'count', 'disposition'));
    }

    public function getData(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = Disposition::all()->unique('fk_incoming');
        //     foreach ($data as $value) {
        //         if ($value->fk_teacher != null) {
        //             $value->teacher = Teacher::where('id', $value->fk_teacher)->first();
        //             $dispositions = Disposition::where('fk_incoming', $value->fk_incoming)->get();
        //             $value->teachers = "";
        //             foreach ($dispositions as $values) {
        //                 $name = Teacher::where('id', $values->fk_teacher)->first();
        //                 $value->teachers = $value->teachers . $name->name . ', ';
        //             }
        //             $value->teachers = substr($value->teachers, 0, -2);
        //         }
        //         $value->incoming;
        //         $value->responsive_id = "";
        //     }
        //     return DataTables::of($data)
        //         ->make(true);
        // } else {
        //     $data = Disposition::all()->unique('fk_incoming');
        //     foreach ($data as $value) {
        //         if ($value->fk_teacher != null) {
        //             $value->teacher = Teacher::where('id', $value->fk_teacher)->first();
        //             $dispositions = Disposition::where('fk_incoming', $value->fk_incoming)->get();
        //             $value->teachers = "";
        //             foreach ($dispositions as $values) {
        //                 $name = Teacher::where('id', $values->fk_teacher)->first();
        //                 $value->teachers = $value->teachers . $name->name . ', ';
        //             }
        //             $value->teachers = substr($value->teachers, 0, -2);
        //         }
        //         $value->incoming;
        //         $value->responsive_id = "";
        //     }
        //     return DataTables::of($data)
        //         ->make(true);
        // }
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
        $file->move(public_path('assets/report/disposition'), $filename);
        $disposition = Disposition::find($id);
        $disposition->letter = asset('assets/report/disposition/' . $filename);
        $disposition->save();
        return redirect()->back();
    }
}
