<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\AnalystChse;
use App\Models\AnalystGizi;
use App\Models\Imt;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $data['clean'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'clean')->count();
        $data['health'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'health')->count();
        $data['safety'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'safety')->count();
        $data['environment'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'environment')->count();

        $data['morning'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'breakfast')->count();
        $data['launch'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'launch')->count();
        $data['dinner'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'dinner')->count();
        $data['snack'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'snack')->count();

        $data['imt'] = Imt::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(5)->get();
        $data['report'] = Report::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(5)->get();

        return view('worker.dashboard.index', $data);
    }
}
