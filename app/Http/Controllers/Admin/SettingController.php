<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outgoing;
use App\Models\Setup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $outgoing = Outgoing::all();
        $count = count($outgoing->where('status', 0));
        $setup = Setup::first();
        return view('admin.setting.index', compact('user', 'count', 'setup'));
    }

    public function edit(Request $request)
    {
        $setup = Setup::first();
        $setup->incoming_start = $this->number($request->incoming_start);
        $setup->outgoing_start = $this->number($request->outgoing_start);
        $setup->periode = $request->periode;
        $setup->save();

        return redirect()->back();
    }

    public function number($number)
    {
        if (strlen((int)$number) == 1) {
            $number = "00" . $number;
        } elseif (strlen((int)$number) == 2) {
            $number = "0" . $number;
        } else {
            $number = "" . $number;
        }

        return $number;
    }
}
