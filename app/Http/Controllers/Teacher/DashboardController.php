<?php

namespace App\Http\Controllers\Teacher;

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
            if ($value->fk_teacher != null) {
                if ($value->fk_teacher == $user->teacher->nip && $value->incoming->status_teacher == 0) {
                    $incoming->push($value->incoming);
                }
            }
        }
        $incoming->count = count($incoming);
        $count_incoming = count(Incoming::all());
        $surat_masuk = count(Disposition::where('fk_teacher', $user->teacher->nip)->get());
        $surat_keluar = count(Outgoing::where('fk_teacher', $user->teacher->nip)->get());
        return view('teacher.index', compact('user', 'incoming', 'count_incoming', 'surat_masuk', 'surat_keluar'));
    }
}
