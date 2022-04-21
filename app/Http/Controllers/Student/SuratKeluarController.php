<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Headmaster;
use App\Models\Outgoing;
use App\Models\OutgoingType;
use App\Models\Setup;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\returnSelf;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = url('api/student/surat-keluar/index/get', $user->student->id);
        $read = url('student/surat-keluar/read');
        $delete = url('student/surat-keluar/delete');
        $type = OutgoingType::where('id', '=', 3)->get();
        $type_add = OutgoingType::find(6);
        $type->push($type_add);
        $outgoing = Outgoing::where('id_student', $user->student->id)->get();
        foreach ($outgoing as $value) {
            $date = substr($value->created_at, 0, 10);
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        return view('student.surat_keluar.index', compact('user', 'data', 'read', 'delete', 'type', 'outgoing'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Outgoing::where('id_student', $id)->get();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->student;
                $value->admin;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)->make(true);
        } else {
            $data = Outgoing::where('id_student', $id)->get();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->student;
                $value->admin;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)->make(true);
        }
    }

    public function read($id)
    {
        $surat = Outgoing::where('id', $id)->first();
        return redirect()->to($surat->letter);
    }

    public function delete($id)
    {
        $surat = Outgoing::where('id', $id)->delete();
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'masuk_mutasi' => "required|before:today",
            'keluar_mutasi' => "required",
            'alasan_mutasi' => "required",
        ], [
            'masuk_mutasi.required' => 'Tanggal masuk harus diisi',
            'masuk_mutasi.before' => 'Tanggal masuk harus sebelum hari ini',
            'keluar_mutasi.required' => 'Tanggal keluar harus diisi',
            'alasan_mutasi.required' => 'Alasan keluar harus diisi',
        ]);
        $this->validate($request, [
            'to' => "required",
            'detail' => "required",
        ], [
            'to.required' => 'Tujuan surat harus diisi',
            'detail.required' => 'Isi pokok surat harus diisi',
        ]);
        $user = Auth::user()->student;
        $birthday = substr($user->birthday, 0, 10);
        $user->birthday = Carbon::createFromFormat('Y-m-d', $birthday)->isoFormat('DD MMMM Y');
        $filename = Carbon::now()->format('dmyHis') . '.pdf';
        $outgoing_last = Outgoing::latest('id')->first();
        $outgoing_type = OutgoingType::find($request->id_type);
        $number = $this->number_generator($outgoing_type->number);
        $now = Carbon::now()->isoFormat('DD MMMM Y');
        $headmaster = Headmaster::first();
        $setup = Setup::first();
        if ($request->id_type == 3) {
            $pdf = Pdf::loadview('report.keterangan', compact('request', 'number', 'now', 'headmaster', 'user', 'setup'))->setPaper('a4', 'portrait');
            $pdf->save(public_path('assets/report/outgoing/')  . $filename);
        } elseif ($request->id_type == 4) {
            $masuk = Carbon::createFromFormat('Y-m-d', $request->masuk_mutasi)->isoFormat('DD MMMM Y');
            $keluar = Carbon::createFromFormat('Y-m-d', $request->keluar_mutasi)->isoFormat('DD MMMM Y');
            $pdf = Pdf::loadview('report.keterangan_mutasi', compact('request', 'number', 'now', 'headmaster', 'user', 'setup', 'masuk', 'keluar'))->setPaper('a4', 'portrait');
            $pdf->save(public_path('assets/report/outgoing/')  . $filename);
        } elseif ($request->id_type == 6) {
            $this->validate($request, [
                'ayahsih' => "required",
                'ibusih' => "required",
                'no_ijazahsih' => "required",
                'tahun_ajaransih' => "required",
                'polseksih' => "required",
                'tanggal_surat_laporsih' => "required",
                'no_suratsih' => "required",
            ], [
                'ayahsih.required' => 'Nama ayah harus diisi',
                'ibusih.required' => 'Nama ibu harus diisi',
                'no_ijazahsih.required' => 'No ijazah harus diisi',
                'tahun_ajaransih.required' => 'Tahun ajaran harus diisi',
                'polseksih.required' => 'Kantor polsek harus diisi',
                'tanggal_surat_laporsih.required' => 'Tanggal Surat Lapor dari polsek harus diisi',
                'no_suratsih.required' => 'No surat harus diisi',
            ]);
            $pdf = Pdf::loadview('report.keterangan_ijazah_hilang', compact('request', 'number', 'now', 'headmaster', 'user', 'setup'))->setPaper('a4', 'portrait');
            $pdf->save(public_path('assets/report/outgoing/')  . $filename);
        }

        $outgoing =  new Outgoing;
        $outgoing->number = $number;
        $outgoing->to = $request->to;
        $outgoing->detail = $request->detail;
        $outgoing->letter = asset('assets/report/outgoing/' . $filename);
        $outgoing->id_type = $request->id_type;
        $outgoing->id_student = $user->id;
        $outgoing->save();
        return redirect()->back();
    }

    public function number_generator($code)
    {
        $setup = Setup::first();
        $year = Carbon::now()->format('Y');
        if (strlen((int)$setup->outgoing_start) == 1) {
            $setup->outgoing_start = (int) $setup->outgoing_start + 1;
            $setup->outgoing_start = "00" . $setup->outgoing_start;
            $setup->save();
            $result = $code . "/" . $setup->outgoing_start . '/405.07.3.23' . '/' . $year;
        } elseif (strlen((int)$setup->outgoing_start) == 2) {
            $setup->outgoing_start = (int) $setup->outgoing_start + 1;
            $setup->outgoing_start = "0" . $setup->outgoing_start;
            $setup->save();
            $result = $code . "/" . $setup->outgoing_start . '/405.07.3.23' . '/' . $year;
        } else {
            $setup->outgoing_start = (int) $setup->outgoing_start + 1;
            $setup->outgoing_start = $setup->outgoing_start;
            $setup->save();
            $result = $code . "/" . $setup->outgoing_start . '/405.07.3.23' . '/' . $year;
        }
        return $result;
    }
}
