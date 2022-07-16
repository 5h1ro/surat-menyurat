<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Incoming;
use App\Models\Outgoing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
        $count_incoming = count(Incoming::all());
        $surat_masuk = count(Disposition::where('fk_staff', $user->staff->nip)->get());
        $surat_keluar = count(Outgoing::where('fk_staff', $user->staff->nip)->get());
        return view('staff.index', compact('user', 'incoming', 'count_incoming','surat_masuk','surat_keluar'));
    }
}
