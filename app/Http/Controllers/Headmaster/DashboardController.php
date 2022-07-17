<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Fixing;
use App\Models\Incoming;
use App\Models\Outgoing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $count = count($incoming = Incoming::where([['fk_headmaster', '=', $user->headmaster->nip], ['status', '=', 0]])->get());
        $count = count($outgoing = Outgoing::where('status', '>=', 2)->get());
        $incoming->count = count($incoming);
        $outgoing->count = count($outgoing->where('status', 2));
        $count_incoming = count(Incoming::where([['fk_headmaster', '=', $user->headmaster->nip], ['status', '=', 0]])->get());
        $count_outgoing = count(Outgoing::where('status', '>=', 2)->get());
        $count_disposition = count(Disposition::all());
        $count_fixing = count(Fixing::where('status', '>=', 2)->get());

        return view('headmaster.index', compact('user', 'incoming', 'outgoing', 'count_incoming', 'count_outgoing', 'count_disposition', 'count_fixing'));
    }
}
