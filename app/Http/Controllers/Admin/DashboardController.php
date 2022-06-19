<?php

namespace App\Http\Controllers\Admin;

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
        $outgoing = Outgoing::all();
        $count = count($outgoing->where('status', 0));
        $count_incoming = count(Incoming::all());
        $count_outgoing = count(Outgoing::all());
        $count_disposition = count(Disposition::all());
        $count_fixing = count(Fixing::all());
        $incoming = Incoming::where('letter')->count();
        return view('admin.index', compact('user', 'count', 'count_incoming', 'count_outgoing', 'count_disposition', 'count_fixing'));
    }
}
