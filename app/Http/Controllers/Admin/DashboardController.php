<?php

namespace App\Http\Controllers\Admin;

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
        $data['clean'] = AnalystChse::where('type', 'clean')->count();
        $data['health'] = AnalystChse::where('type', 'health')->count();
        $data['safety'] = AnalystChse::where('type', 'safety')->count();
        $data['environment'] = AnalystChse::where('type', 'environment')->count();

        $data['morning'] = AnalystGizi::where('type', 'breakfast')->count();
        $data['launch'] = AnalystGizi::where('type', 'launch')->count();
        $data['dinner'] = AnalystGizi::where('type', 'dinner')->count();
        $data['snack'] = AnalystGizi::where('type', 'snack')->count();

        $data['imt'] = Imt::orderBy('created_at', 'desc')->limit(5)->get();
        $data['report'] = Report::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard.index', $data);
    }

    public function callCenter()
    {
        return view('admin.call-center.index');
    }
}
