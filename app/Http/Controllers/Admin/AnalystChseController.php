<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalystChse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalystChseController extends Controller
{
    public function index()
    {
        $data['clean'] = AnalystChse::where('type', 'clean')->count();
        $data['health'] = AnalystChse::where('type', 'health')->count();
        $data['safety'] = AnalystChse::where('type', 'safety')->count();
        $data['environment'] = AnalystChse::where('type', 'environment')->count();

        $last = AnalystChse::select('type', 'user_id', 'created_at')->where('user_id', null)->orderBy('created_at', 'desc')->get();
        // dd($last);
        $data['lastC'] = $last->where('type', 'clean')->first();
        $data['lastH'] = $last->where('type', 'health')->first();
        $data['lastS'] = $last->where('type', 'safety')->first();
        $data['lastE'] = $last->where('type', 'environment')->first();

        return view('admin.analyst-chse.index', $data);
    }

    public function clean()
    {
        return view('admin.analyst-chse.clean');
    }

    public function health()
    {
        return view('admin.analyst-chse.health');
    }

    public function safety()
    {
        return view('admin.analyst-chse.safety');
    }

    public function environment()
    {
        return view('admin.analyst-chse.environment');
    }

    public function chseStore(Request $request)
    {
        $data = ['number', 'type', 'check', 'place', 'catatan', 'photo'];

        for ($i=0; $i < 2; $i++) {
            if ($i == 0) {
                for ($j=0; $j < count($data); $j++) {
                    $satu[$data[$j]] = $request[$data[$j].$i];
                }
                if ($satu['photo'] != null) {
                    $satu['photo'] = $this->file_upload('/analisis-chse', $satu['photo']);
                }
                $satu['created_at'] = Carbon::create('now');
            } else {
                for ($j=0; $j < count($data); $j++) {
                    $dua[$data[$j]] = $request[$data[$j].$i];
                }
                if ($dua['photo'] != null) {
                    $dua['photo'] = $this->file_upload('/analisis-chse', $dua['photo']);
                }
                $dua['created_at'] = Carbon::create('now');
            }
        }

        DB::table('analyst_chses')->insert([$satu, $dua]);

        return redirect()->route('admin.analisis-chse.index');
    }
}
