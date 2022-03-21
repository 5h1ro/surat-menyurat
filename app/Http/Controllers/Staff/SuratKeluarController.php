<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Headmaster;
use App\Models\Outgoing;
use App\Models\OutgoingType;
use App\Models\Setup;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $disposition = Disposition::all();
        $incoming = collect();
        foreach ($disposition as $value) {
            if ($value->id_staff != null) {
                if ($value->id_staff == $user->staff->id && $value->incoming->status_teacher == 0) {
                    $incoming->push($value->incoming);
                }
            }
        }
        $incoming->count = count($incoming);
        $data = url('api/staff/surat-keluar/index/get', $user->staff->id);
        $read = url('staff/surat-keluar/read');
        $delete = url('staff/surat-keluar/delete');
        $type = OutgoingType::where('id', '<=', 4)->get();
        $outgoing = Outgoing::where('id_staff', $user->staff->id)->get();
        foreach ($outgoing as $value) {
            $date = substr($value->created_at, 0, 10);
            $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
        }
        return view('staff.surat_keluar.index', compact('user', 'data', 'read', 'delete', 'type', 'incoming', 'outgoing'));
    }

    public function getData($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Outgoing::where('id_staff', $id)->get();
            foreach ($data as $value) {
                $date = substr($value->created_at, 0, 10);
                $value->date = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD MMMM Y');
                $value->staff;
                $value->admin;
                $value->type;
                $value->responsive_id = "";
            }
            return DataTables::of($data)->make(true);
        } else {
            $data = Outgoing::where('id_staff', $id)->get();
            foreach ($data as $value) {
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
        $surat = Outgoing::where('id', $id)->delete();
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $filename = Carbon::now()->format('dmyHis') . '.pdf';
        $outgoing_last = Outgoing::latest('id')->first();
        $outgoing_type = OutgoingType::find($request->id_type);
        $number = $this->number_generator($outgoing_type->number);
        $user = Auth::user();
        $now = Carbon::now()->isoFormat('DD MMMM Y');
        $start = substr($request->date, 0, 10);
        $end = substr($request->date, -10);
        $start_day = Carbon::createFromFormat('Y-m-d', $start)->dayName;
        $end_day = Carbon::createFromFormat('Y-m-d', $end)->dayName;
        $start = Carbon::createFromFormat('Y-m-d', $start)->isoFormat('DD');
        $end = Carbon::createFromFormat('Y-m-d', $end)->isoFormat('DD MMMM Y');
        $headmaster = Headmaster::first();
        $pdf = Pdf::loadview('report.undangan', compact('request', 'number', 'now', 'start', 'start_day', 'end', 'end_day', 'headmaster'))->setPaper('a4', 'portrait');
        $pdf->save(public_path('assets/report/outgoing/')  . $filename);

        $outgoing =  new Outgoing;
        $outgoing->number = $number;
        $outgoing->to = $request->to;
        $outgoing->detail = $request->detail;
        $outgoing->letter = asset('assets/report/outgoing/' . $filename);
        $outgoing->id_type = $request->id_type;
        $outgoing->id_staff = $user->staff->id;
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
