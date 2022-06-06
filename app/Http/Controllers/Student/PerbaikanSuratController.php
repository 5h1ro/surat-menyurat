<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Fixing;
use App\Models\FixingType;
use App\Models\Headmaster;
use App\Models\Outgoing;
use App\Models\OutgoingType;
use App\Models\Setup;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\returnSelf;

class PerbaikanSuratController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = url('api/student/perbaikan-surat/index/get', $user->student->nisn);
        $read = url('student/perbaikan-surat/read');
        $delete = url('student/perbaikan-surat/delete');
        $type = FixingType::all();
        // $type_add = OutgoingType::find(6);
        // $type->push($type_add);
        $fixing = $user->student->fixing;
        foreach ($fixing as $value) {
            $date = substr($value->created_at, 0, 10);
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        return view('student.perbaikan_surat.index', compact('user', 'data', 'read', 'delete', 'type', 'fixing'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Fixing::where('fk_student', $id)->get();
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
            $data = Fixing::where('fk_student', $id)->get();
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
        $surat = Fixing::find($id)->first();
        return redirect()->to($surat->letter);
    }

    public function delete($id)
    {
        $surat = Fixing::find($id)->delete();
        return redirect()->back();
    }

    public function create(Request $request)
    {
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
        // $outgoing_last = Outgoing::latest('id')->first();
        $fixing_type = FixingType::find($request->fk_type);
        $number = $this->number_generator($fixing_type->number);
        $now = Carbon::now()->isoFormat('DD MMMM Y');
        $headmaster = Headmaster::first();
        $setup = Setup::first();
        // if ($request->fk_type == 3) {
        //     $pdf = Pdf::loadview('report.keterangan', compact('request', 'number', 'now', 'headmaster', 'user', 'setup'))->setPaper('a4', 'portrait');
        //     $pdf->save(public_path('assets/report/outgoing/')  . $filename);
        // } elseif ($request->fk_type == 4) {
        //     $masuk = Carbon::createFromFormat('Y-m-d', $request->masuk_mutasi)->isoFormat('DD MMMM Y');
        //     $keluar = Carbon::createFromFormat('Y-m-d', $request->keluar_mutasi)->isoFormat('DD MMMM Y');
        //     $pdf = Pdf::loadview('report.keterangan_mutasi', compact('request', 'number', 'now', 'headmaster', 'user', 'setup', 'masuk', 'keluar'))->setPaper('a4', 'portrait');
        //     $pdf->save(public_path('assets/report/outgoing/')  . $filename);
        // }


        if ($request->fk_type == 'FT-01') {
            $student = $user;
            $student_date = $student->birthday;
            $this->validate($request, [
                'nomor_ijazah' => "required",
                'nomor_peserta' => "required",
                'tahun_pelajaran' => "required",
            ], [
                'nomor_ijazah.required' => 'Nomor ijazah harus diisi',
                'nomor_peserta.required' => 'Nomor peserta harus diisi',
                'tahun_pelajaran.required' => 'Tahun pelajaran harus diisi',
            ]);
            if ($request->tipe_kesalahan == 1) {
                $this->validate($request, [
                    'nama_benarns' => "required",
                    'nama_salahns' => "required",
                    'dispendukcapilns' => "required",
                    'nomor_aktans' => "required",
                    'tanggal_aktans' => "required|before:today",
                    'nama_sdns' => "required",
                    'sk_sdns' => "required",
                    'tanggal_sk_sdns' => "required|before:today",
                ], [
                    'nama_benarns.required' => 'Nama yang benar harus diisi',
                    'nama_salahns.required' => 'Nama yang salah harus diisi',
                    'dispendukcapilns.required' => 'Kantor Dispendukcapil harus diisi',
                    'nomor_aktans.required' => 'Nomor akta kelahiran harus diisi',
                    'tanggal_aktans.required' => 'Tanggal akta kelahiran harus diisi',
                    'tanggal_aktans.before' => 'Tanggal akta kelahiran harus sebelum hari ini',
                    'nama_sdns.required' => 'Nama SD harus diisi',
                    'sk_sdns.required' => 'No SK SD harus diisi',
                    'tanggal_sk_sdns.required' => 'Tanggal SK SD harus diisi',
                    'tanggal_sk_sdns.before' => 'Tanggal SK SD harus sebelum hari ini',
                ]);
                $tanggal_aktans = Carbon::createFromFormat('Y-m-d', $request->tanggal_aktans)->isoFormat('DD MMMM Y');
                $tanggal_sk_sdns = Carbon::createFromFormat('Y-m-d', $request->tanggal_sk_sdns)->isoFormat('DD MMMM Y');
                $pdf = Pdf::loadview('report.skki_nama', compact('request', 'number', 'now', 'headmaster', 'tanggal_aktans', 'tanggal_sk_sdns', 'student', 'student_date'))->setPaper('a4', 'portrait');
                $pdf->save(public_path('assets/report/fixing/')  . $filename);
            } elseif ($request->tipe_kesalahan == 2) {
                $this->validate($request, [
                    'tempat_lahir_benartl' => "required",
                    'tempat_lahir_salahtl' => "required",
                    'dispendukcapiltl' => "required",
                    'nomor_aktatl' => "required",
                    'tanggal_aktatl' => "required|before:today",
                ], [
                    'tempat_lahir_benartl.required' => 'Tempat lahir yang benar harus diisi',
                    'tempat_lahir_salahtl.required' => 'Tempat lahir yang salah harus diisi',
                    'dispendukcapiltl.required' => 'Kantor Dispendukcapil harus diisi',
                    'nomor_aktatl.required' => 'Nomor akta kelahiran harus diisi',
                    'tanggal_aktatl.required' => 'Tanggal akta kelahiran harus diisi',
                    'tanggal_aktatl.before' => 'Tanggal akta kelahiran harus sebelum hari ini',
                ]);
                $tanggal_aktatl = Carbon::createFromFormat('Y-m-d', $request->tanggal_aktatl)->isoFormat('DD MMMM Y');
                $pdf = Pdf::loadview('report.skki_tempat', compact('request', 'number', 'now', 'headmaster', 'tanggal_aktatl', 'student', 'student_date'))->setPaper('a4', 'portrait');
                $pdf->save(public_path('assets/report/fixing/')  . $filename);
            } elseif ($request->tipe_kesalahan == 3) {
                $this->validate($request, [
                    'tanggal_lahir_benartgl' => "required",
                    'tanggal_lahir_salahtgl' => "required",
                    'dispendukcapiltgl' => "required",
                    'nomor_aktatgl' => "required",
                    'tanggal_aktatgl' => "required|before:today",
                ], [
                    'tanggal_lahir_benartgl.required' => 'Tanggal lahir yang benar harus diisi',
                    'tanggal_lahir_salahtgl.required' => 'Tanggal lahir yang salah harus diisi',
                    'dispendukcapiltgl.required' => 'Kantor Dispendukcapil harus diisi',
                    'nomor_aktatgl.required' => 'Nomor akta kelahiran harus diisi',
                    'tanggal_aktatgl.required' => 'Tanggal akta kelahiran harus diisi',
                    'tanggal_aktatgl.before' => 'Tanggal akta kelahiran harus sebelum hari ini',
                ]);
                $tanggal_lahir_benartgl = Carbon::createFromFormat('Y-m-d', $request->tanggal_lahir_benartgl)->isoFormat('DD MMMM Y');
                $tanggal_lahir_salahtgl = Carbon::createFromFormat('Y-m-d', $request->tanggal_lahir_salahtgl)->isoFormat('DD MMMM Y');
                $tanggal_aktatgl = Carbon::createFromFormat('Y-m-d', $request->tanggal_aktatgl)->isoFormat('DD MMMM Y');
                $pdf = Pdf::loadview('report.skki_tanggal', compact('request', 'number', 'now', 'headmaster', 'tanggal_aktatgl', 'student', 'student_date', 'tanggal_lahir_salahtgl', 'tanggal_lahir_benartgl'))->setPaper('a4', 'portrait');
                return $pdf->stream();
            } else {
                $this->validate($request, [
                    'nama_wali_benarnw' => "required",
                    'nama_wali_salahnw' => "required",
                    'dispendukcapilnw' => "required",
                    'nomor_aktanw' => "required",
                    'tanggal_aktanw' => "required|before:today",
                ], [
                    'nama_wali_benarnw.required' => 'Nama wali yang benar harus diisi',
                    'nama_wali_salahnw.required' => 'Nama wali yang salah harus diisi',
                    'dispendukcapilnw.required' => 'Kantor Dispendukcapil harus diisi',
                    'nomor_aktanw.required' => 'Nomor akta kelahiran harus diisi',
                    'tanggal_aktanw.required' => 'Tanggal akta kelahiran harus diisi',
                    'tanggal_aktanw.before' => 'Tanggal akta kelahiran harus sebelum hari ini',
                ]);
                $tanggal_aktanw = Carbon::createFromFormat('Y-m-d', $request->tanggal_aktanw)->isoFormat('DD MMMM Y');
                $pdf = Pdf::loadview('report.skki_wali', compact('request', 'number', 'now', 'headmaster', 'tanggal_aktanw', 'student', 'student_date'))->setPaper('a4', 'portrait');
                return $pdf->stream();
            }
        } elseif ($request->fk_type == 'FT-02') {
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
            $pdf->save(public_path('assets/report/fixing/')  . $filename);
        }

        $id = IdGenerator::generate(['table' => 'fixings', 'length' => 8, 'prefix' => 'FX-']);
        $fixing =  new Fixing;
        $fixing->id = $id;
        $fixing->number = $number;
        $fixing->to = $request->to;
        $fixing->detail = $request->detail;
        $fixing->letter = asset('assets/report/fixing/' . $filename);
        $fixing->fk_type = $request->fk_type;
        $fixing->fk_student = $user->nisn;
        $fixing->save();
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
