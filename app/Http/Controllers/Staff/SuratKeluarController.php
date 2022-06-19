<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Headmaster;
use App\Models\Outgoing;
use App\Models\OutgoingType;
use App\Models\Setup;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $disposition = Disposition::all();
        $incoming = collect();
        foreach ($disposition as $value) {
            if ($value->fk_staff != null) {
                if ($value->fk_staff == $user->staff->nip && $value->incoming->status_teacher == 0) {
                    $incoming->push($value->incoming);
                }
            }
        }
        $incoming->count = count($incoming);
        $data = url('api/staff/surat-keluar/index/get', $user->staff->nip);
        $read = url('staff/surat-keluar/read');
        $delete = url('staff/surat-keluar/delete');
        $type = OutgoingType::where([['id', '<=', 'OT-03']])->get();
        $outgoing = $user->staff->outgoing;
        $student = Student::all();
        foreach ($outgoing as $value) {
            $date = substr($value->created_at, 0, 10);
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        return view('staff.surat_keluar.index', compact('user', 'data', 'read', 'delete', 'type', 'incoming', 'outgoing', 'student'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Outgoing::where('fk_staff', $id)->get();
            foreach ($data as $value) {
                $value->number_encrypt = Crypt::encrypt($value->id);
                $value->number_md5 = md5($value->id);
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->staff;
                $value->admin;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)->make(true);
        } else {
            $data = Outgoing::where('fk_staff', $id)->get();
            foreach ($data as $value) {
                $value->number_encrypt = Crypt::encrypt($value->id);
                $value->number_md5 = md5($value->id);
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->staff;
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
        $surat = Outgoing::find(Crypt::decrypt($id))->delete();
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $filename = Carbon::now()->format('dmyHis') . '.pdf';
        $outgoing_last = Outgoing::latest('id')->first();
        $outgoing_type = OutgoingType::find($request->fk_type);
        $number = $this->number_generator($outgoing_type->number);
        $user = Auth::user();
        $now = Carbon::now()->isoFormat('DD MMMM Y');
        $headmaster = Headmaster::first();
        $setup = Setup::first();
        $this->validate($request, [
            'to' => "required",
            'detail' => "required",
        ], [
            'to.required' => 'Tujuan surat harus diisi',
            'detail.required' => 'Isi pokok surat harus diisi',
        ]);
        if ($request->fk_type == 'OT-01') {
            $this->validate($request, [
                'date' => "required",
                'time' => "required",
                'place' => "required",
                'necessary' => "required",
            ], [
                'date.required' => 'Tanggal harus diisi',
                'time.required' => 'Waktu harus diisi',
                'place.required' => 'Tempat harus diisi',
                'necessary.required' => 'Keperluan harus diisi',
            ]);
            $start = substr($request->date, 0, 10);
            $end = substr($request->date, -10);
            $start_day = Carbon::createFromFormat('Y-m-d', $start)->dayName;
            $end_day = Carbon::createFromFormat('Y-m-d', $end)->dayName;
            $start = Carbon::createFromFormat('Y-m-d', $start)->isoFormat('DD');
            $end = Carbon::createFromFormat('Y-m-d', $end)->isoFormat('DD MMMM Y');
            $pdf = Pdf::loadview('report.undangan', compact('request', 'number', 'now', 'start', 'start_day', 'end', 'end_day', 'headmaster'))->setPaper('a4', 'portrait');
            $pdf->save(public_path('assets/report/outgoing/')  . $filename);
        } elseif ($request->fk_type == 'OT-02') {
            $this->validate($request, [
                'date_pensiun' => "required",
            ], [
                'date_pensiun.required' => 'Tanggal harus diisi',
            ]);
            $date = Carbon::createFromFormat('Y-m-d', $request->date_pensiun)->isoFormat('DD MMMM Y');
            $user->type = 'Staff TU';
            $pdf = Pdf::loadview('report.pensiun', compact('request', 'number', 'now', 'headmaster', 'date', 'user'))->setPaper('a4', 'portrait');
            $pdf->save(public_path('assets/report/outgoing/')  . $filename);
        } elseif ($request->fk_type == 'OT-03') {
            if ($request->tipe_keterangan == 1) {
                $this->validate($request, [
                    'nama' => "required",
                    'tempat_lahir' => "required",
                    'tanggal_lahir' => "required",
                    'asal_sekolah' => "required",
                    'kelas' => "required",
                ], [
                    'nama.required' => 'Nama harus diisi',
                    'tempat_lahir.required' => 'Tempat lahir harus diisi',
                    'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
                    'asal_sekolah.required' => 'Asal sekolah harus diisi',
                    'kelas.required' => 'Kelas harus diisi',
                ]);
                $date = Carbon::createFromFormat('Y-m-d', $request->tanggal_lahir)->isoFormat('DD MMMM Y');
                $pdf = Pdf::loadview('report.skbm', compact('request', 'number', 'now', 'headmaster', 'date'))->setPaper('a4', 'portrait');
                $pdf->save(public_path('assets/report/outgoing/')  . $filename);
            } else {
                $student = Student::find($request->fk_student);
                $student_date = Carbon::createFromFormat('Y-m-d', $student->birthday)->isoFormat('DD MMMM Y');
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
                    $pdf->save(public_path('assets/report/outgoing/')  . $filename);
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
                    $pdf->save(public_path('assets/report/outgoing/')  . $filename);
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
            }
        }

        $id = IdGenerator::generate(['table' => 'outgoings', 'length' => 8, 'prefix' => 'OT-']);
        $outgoing =  new Outgoing;
        $outgoing->id = $id;
        $outgoing->number = $number;
        $outgoing->to = $request->to;
        $outgoing->detail = $request->detail;
        $outgoing->letter = asset('assets/report/outgoing/' . $filename);
        $outgoing->fk_type = $request->fk_type;
        $outgoing->fk_staff = $user->staff->nip;
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
