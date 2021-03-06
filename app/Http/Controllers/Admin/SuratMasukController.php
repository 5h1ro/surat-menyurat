<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Headmaster;
use App\Models\Incoming;
use App\Models\IncomingType;
use App\Models\Outgoing;
use App\Models\OutgoingType;
use App\Models\Role;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\isNull;

class SuratMasukController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        // $data = url('api/admin/surat-masuk/index/get');
        $read = url('admin/surat-masuk/read');
        $delete = url('admin/surat-masuk/delete');
        $role = Role::where([['id', '<=', 2]])->get();
        $type = IncomingType::all();
        $headmaster = Headmaster::all();
        $teacher = Teacher::all();
        $incoming = Incoming::all();
        $outgoing = Outgoing::all();
        $data = Incoming::paginate(10);
        $count = count($outgoing->where('status', 0));
        return view('admin.surat_masuk.index', compact('user', 'data', 'read', 'role', 'type', 'headmaster', 'teacher', 'delete', 'incoming', 'count'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Incoming::limit(10);
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Incoming::limit(10);
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function search($detail, Request $request)
    {
        // if ($request->ajax()) {
        //     if ($detail == "null") {
        //         $data = Incoming::limit(10);
        //     } else {
        //         $data = Incoming::where('detail', 'like', '%' . $detail . '%')->limit(10);
        //     }
        //     return DataTables::of($data)
        //         ->make(true);
        // } else {
        //     if ($detail == "null") {
        //         $data = Incoming::limit(10);
        //     } else {
        //         $data = Incoming::where('detail', 'like', '%' . $detail . '%')->limit(10);
        //     }
        //     return DataTables::of($data)
        //         ->make(true);
        // }


        $user = Auth::user();
        // $data = url('api/admin/surat-masuk/index/get');
        $read = url('admin/surat-masuk/read');
        $delete = url('admin/surat-masuk/delete');
        $role = Role::where([['id', '<=', 2]])->get();
        $type = IncomingType::all();
        $headmaster = Headmaster::all();
        $teacher = Teacher::all();
        $incoming = Incoming::all();
        $outgoing = Outgoing::all();

        if ($detail == "null") {
            $data = Incoming::paginate(10);
        } else {
            $data = Incoming::where('detail', 'like', '%' . $detail . '%')->paginate(10);
        }
        $count = count($outgoing->where('status', 0));
        return view('admin.surat_masuk.index', compact('user', 'data', 'read', 'role', 'type', 'headmaster', 'teacher', 'delete', 'incoming', 'count'));
    }

    public function read($id)
    {
        $surat = Incoming::find(Crypt::decrypt($id));
        return redirect()->to($surat->letter);
    }

    public function delete($id)
    {
        $surat = Incoming::find(Crypt::decrypt($id))->delete();
        return redirect()->back();
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'letter_number' => "required",
            'letter_number' => "required",
            'letter_date' => "required|before_or_equal:today",
            'from' => "required",
            'title' => "required",
            'detail' => "required",
            'fk_type' => "required",
            'fk_headmaster' => "required",
            'information' => "required",
            'letter' => "required|mimes:pdf",
        ], [
            'letter_number.required' => 'Nomor surat tidak boleh kosong',
            'letter_date.required' => 'Tanggal surat tidak boleh kosong',
            'letter_date.before_or_equal' => 'Tanggal surat tidak boleh lebih dari hari ini',
            'from.required' => 'Asal surat tidak boleh kosong',
            'title.required' => 'Nama dan Alamat tidak boleh kosong',
            'detail.required' => 'Isi pokok surat tidak boleh kosong',
            'fk_type.required' => 'Tipe tidak boleh kosong',
            'fk_headmaster.required' => 'Kepala sekolah tidak boleh kosong',
            'information.required' => 'Jenis surat tidak boleh kosong',
            'letter.required' => 'Scan surat tidak boleh kosong',
            'letter.mimes' => 'File harus berformat pdf',
        ]);
        $last_incoming = Incoming::orderBy('number', 'DESC')->first();
        $letter_date = Carbon::createFromFormat('Y-m-d', $request->letter_date)->isoFormat('DD MMMM Y');
        $date = Carbon::now()->isoformat('DD MMMM Y');
        $number = substr($last_incoming->number, 4, 3);
        $number_front = substr($last_incoming->number, 0, 4);
        $number_end = substr($last_incoming->number, 7);
        if (strlen((int)$number) == 1) {
            $number = (int) $number + 1;
            $number = $number_front . "00" . $number . $number_end;
        } elseif (strlen((int)$number) == 2) {
            $number = (int) $number + 1;
            $number = $number_front . "0" . $number . $number_end;
        } else {
            $number = (int) $number + 1;
            $number = $number_front . "" . $number . $number_end;
        }
        $user = Auth::user();
        $now = Carbon::now()->format('dmYHis');
        $filename = $now . '.pdf';
        $file = $request->file('letter');
        $file->move(public_path('assets/report/incoming'), $filename);
        $incoming = new Incoming;
        $incoming->number = $number;
        $incoming->title = $request->title;
        $incoming->letter_number = $request->letter_number;
        $incoming->letter_date = $request->letter_date;
        $incoming->from = $request->from;
        $incoming->detail = $request->detail;
        $incoming->letter = asset('assets/report/incoming/' . $filename);
        $incoming->fk_type = $request->fk_type;
        $incoming->fk_admin = $user->admin->nip;
        $incoming->fk_headmaster = $request->fk_headmaster;
        $incoming->save();
        $pdf = Pdf::loadview('report.disposisi', compact('incoming', 'request', 'date', 'letter_date'))->setPaper('a4', 'portrait');
        $pdf->save(public_path('assets/report/disposition/')  . $filename);
        $id = IdGenerator::generate(['table' => 'dispositions', 'length' => 8, 'prefix' => 'DP-']);
        $disposition = new Disposition;
        $disposition->id = $id;
        $disposition->information = $request->information;
        $disposition->fk_incoming = $incoming->number;
        $disposition->letter = asset('assets/report/disposition/' . $filename);
        $disposition->save();
        return redirect()->back();
    }

    public function month($month)
    {
        if ($month == '01') {
            $month = 'Januari';
        } elseif ($month == '02') {
            $month = 'Februari';
        } elseif ($month == '03') {
            $month = 'Maret';
        } elseif ($month == '04') {
            $month = 'April';
        } elseif ($month == '05') {
            $month = 'Mei';
        } elseif ($month == '06') {
            $month = 'Juni';
        } elseif ($month == '07') {
            $month = 'Juli';
        } elseif ($month == '08') {
            $month = 'Agustus';
        } elseif ($month == '09') {
            $month = 'September';
        } elseif ($month == '10') {
            $month = 'Oktober';
        } elseif ($month == '11') {
            $month = 'November';
        } elseif ($month == '12') {
            $month = 'Desember';
        }
        return $month;
    }
}
