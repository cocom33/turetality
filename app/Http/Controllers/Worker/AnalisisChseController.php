<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\AnalystChse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisisChseController extends Controller
{
    public function index()
    {
        $last = AnalystChse::select('type', 'user_id', 'created_at', 'number')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $data['clean'] = $last->where('type', 'clean')->count();
        $data['health'] = $last->where('type', 'health')->count();
        $data['safety'] = $last->where('type', 'safety')->count();
        $data['environment'] = $last->where('type', 'environment')->count();

        $data['lastC'] = $last->where('type', 'clean')->first();
        $data['lastH'] = $last->where('type', 'health')->first();
        $data['lastS'] = $last->where('type', 'safety')->first();
        $data['lastE'] = $last->where('type', 'environment')->first();

        return view('worker.analyst-chse.index', $data);
    }

    public function store(Request $request)
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
                $satu['user_id'] = auth()->user()->id;
                $satu['created_at'] = Carbon::create('now');
            } else {
                for ($j=0; $j < count($data); $j++) {
                    $dua[$data[$j]] = $request[$data[$j].$i];
                }
                if ($dua['photo'] != null) {
                    $dua['photo'] = $this->file_upload('/analisis-chse', $dua['photo']);
                }
                $dua['user_id'] = auth()->user()->id;
                $dua['created_at'] = Carbon::create('now');
            }
        }

        DB::table('analyst_chses')->insert([$satu, $dua]);

        return redirect()->route('analisis-chse.index');
    }


    public function clean1()
    {
        return view('worker.analyst-chse.clean');
    }

    public function health1()
    {
        return view('worker.analyst-chse.health');
    }

    public function safety1()
    {
        return view('worker.analyst-chse.safety');
    }

    public function environment1()
    {
        return view('worker.analyst-chse.environment');
    }
}