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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\isNull;

class SuratMasukController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $data = url('api/admin/surat-masuk/index/get');
        $read = url('admin/surat-masuk/read');
        $delete = url('admin/surat-masuk/delete');
        $role = Role::where([['id', '<=', 2]])->get();
        $type = IncomingType::all();
        $headmaster = Headmaster::all();
        $teacher = Teacher::all();
        $incoming = Incoming::all();
        foreach ($incoming as $value) {
            $tanggal = substr($value->created_at, 8, 2);
            $bulan = $this->month(substr($value->created_at, 5, 2));
            $tahun = substr($value->created_at, 0, 4);
            $tanggal_surat = substr($value->letter_date, 8, 2);
            $bulan_surat = $this->month(substr($value->letter_date, 5, 2));
            $tahun_surat = substr($value->letter_date, 0, 4);
            $value->date = $tanggal . ' ' . $bulan . ' ' . $tahun;
            $value->letter_date = $tanggal_surat . ' ' . $bulan_surat . ' ' . $tahun_surat;
            $value->type;
            $value->responsive_id = "";
        }
        $outgoing = Outgoing::all();
        $count = count($outgoing->where('status', 0));
        return view('admin.surat_masuk.index', compact('user', 'data', 'read', 'role', 'type', 'headmaster', 'teacher', 'delete', 'incoming', 'count'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Incoming::all();
            foreach ($data as $value) {
                $tanggal = substr($value->created_at, 8, 2);
                $bulan = $this->month(substr($value->created_at, 5, 2));
                $tahun = substr($value->created_at, 0, 4);
                $tanggal_surat = substr($value->letter_date, 8, 2);
                $bulan_surat = $this->month(substr($value->letter_date, 5, 2));
                $tahun_surat = substr($value->letter_date, 0, 4);
                $value->date = $tanggal . ' ' . $bulan . ' ' . $tahun;
                $value->letter_date = $tanggal_surat . ' ' . $bulan_surat . ' ' . $tahun_surat;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        } else {
            $data = Incoming::all();
            foreach ($data as $value) {
                $tanggal = substr($value->created_at, 8, 2);
                $bulan = $this->month(substr($value->created_at, 5, 2));
                $tahun = substr($value->created_at, 0, 4);
                $value->date = $tanggal . ' ' . $bulan . ' ' . $tahun;
                $value->headmaster;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function read($id)
    {
        $surat = Incoming::where('id', $id)->first();
        return redirect()->to($surat->letter);
    }

    public function delete($id)
    {
        $surat = Incoming::where('id', $id)->delete();
        return redirect()->back();
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'letter_number' => "required",
            'letter_date' => "required|before_or_equal:today",
            'from' => "required",
            'title' => "required",
            'detail' => "required",
            'id_type' => "required",
            'id_headmaster' => "required",
            'information' => "required",
            'letter' => "required",
        ], [
            'letter_number.required' => 'Nomor surat tidak boleh kosong',
            'letter_date.required' => 'Tanggal surat tidak boleh kosong',
            'letter_date.before_or_equal' => 'Tanggal surat tidak boleh lebih dari hari ini',
            'from.required' => 'Asal surat tidak boleh kosong',
            'title.required' => 'Nama dan Alamat tidak boleh kosong',
            'detail.required' => 'Isi pokok surat tidak boleh kosong',
            'id_type.required' => 'Tipe tidak boleh kosong',
            'id_headmaster.required' => 'Kepala sekolah tidak boleh kosong',
            'information.required' => 'Jenis surat tidak boleh kosong',
            'letter.required' => 'Scan surat tidak boleh kosong',
        ]);

        $last_incoming = Incoming::latest()->first();
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
        $incoming->id_type = $request->id_type;
        $incoming->id_admin = $user->admin->id;
        $incoming->id_headmaster = $request->id_headmaster;
        $incoming->save();
        $pdf = Pdf::loadview('report.disposisi', compact('incoming', 'request', 'date', 'letter_date'))->setPaper('a4', 'portrait');
        $pdf->save(public_path('assets/report/disposition/')  . $filename);
        $disposition = new Disposition;
        $disposition->information = $request->information;
        $disposition->id_incoming = $incoming->id;
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
