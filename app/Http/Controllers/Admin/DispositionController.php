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
        //     $data = Disposition::all()->unique('id_incoming');
        //     foreach ($data as $value) {
        //         if ($value->id_teacher != null) {
        //             $value->teacher = Teacher::where('id', $value->id_teacher)->first();
        //             $dispositions = Disposition::where('id_incoming', $value->id_incoming)->get();
        //             $value->teachers = "";
        //             foreach ($dispositions as $values) {
        //                 $name = Teacher::where('id', $values->id_teacher)->first();
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
        //     $data = Disposition::all()->unique('id_incoming');
        //     foreach ($data as $value) {
        //         if ($value->id_teacher != null) {
        //             $value->teacher = Teacher::where('id', $value->id_teacher)->first();
        //             $dispositions = Disposition::where('id_incoming', $value->id_incoming)->get();
        //             $value->teachers = "";
        //             foreach ($dispositions as $values) {
        //                 $name = Teacher::where('id', $values->id_teacher)->first();
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
            $data = Disposition::all()->unique('id_incoming');
            foreach ($data as $value) {
                $dispositions = Disposition::where('id_incoming', $value->id_incoming)->get();
                if ($value->id_teacher != null) {
                    $value->teachers = "";
                    $value->staffs = "";
                    foreach ($dispositions as $values) {
                        if ($values->id_teacher != null) {
                            $name = Teacher::where('id', $values->id_teacher)->first();
                            $value->teachers = $value->teachers . $name->name . ', ';
                        }
                        if ($values->id_staff != null) {
                            if ($values->id_staff != null) {
                                $name_staff = Staff::where('id', $values->id_staff)->first();
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
                    if ($value->id_staff != null) {
                        $value->staffs = "";
                        foreach ($dispositions as $values) {
                            $name = Staff::where('id', $values->id_staff)->first();
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
            $data = Disposition::all()->unique('id_incoming');
            foreach ($data as $value) {
                $dispositions = Disposition::where('id_incoming', $value->id_incoming)->get();
                if ($value->id_teacher != null) {
                    $value->teachers = "";
                    $value->staffs = "";
                    foreach ($dispositions as $values) {
                        if ($values->id_teacher != null) {
                            $name = Teacher::where('id', $values->id_teacher)->first();
                            $value->teachers = $value->teachers . $name->name . ', ';
                        }
                        if ($values->id_staff != null) {
                            if ($values->id_staff != null) {
                                $name_staff = Staff::where('id', $values->id_staff)->first();
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
                    if ($value->id_staff != null) {
                        $value->staffs = "";
                        foreach ($dispositions as $values) {
                            $name = Staff::where('id', $values->id_staff)->first();
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
