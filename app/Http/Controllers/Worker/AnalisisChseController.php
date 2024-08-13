<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\AnalystChse;
use Illuminate\Http\Request;

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

        $c = AnalystChse::select('type', 'user_id', 'created_at', 'number')->where('user_id', auth()->user()->id)->whereDate('created_at', date('Y-m-d'))->get();

        $data['c1'] = $c->where('type', 'clean')->where('number', 1)->first();
        $data['c2'] = $c->where('type', 'clean')->where('number', 2)->first();
        $data['h1'] = $c->where('type', 'health')->where('number', 1)->first();
        $data['h2'] = $c->where('type', 'health')->where('number', 2)->first();
        $data['s1'] = $c->where('type', 'safety')->where('number', 1)->first();
        $data['s2'] = $c->where('type', 'safety')->where('number', 2)->first();
        $data['e1'] = $c->where('type', 'environment')->where('number', 1)->first();
        $data['e2'] = $c->where('type', 'environment')->where('number', 2)->first();

        return view('worker.analyst-chse.index', $data);
    }

    public function store(Request $req)
    {
        $validate = $req->validate([
            'number' => 'required',
            'type' => 'required',
            'check' => 'required',
            'place' => 'required',
            'catatan' => 'required',
            'photo' => 'sometimes',
        ]);

        $validate['user_id'] = auth()->user()->id;

        if ($req['photo'] != null) {
            $validate['photo'] = $this->file_upload('/analisis-chse', $validate['photo']);
        }

        AnalystChse::create($validate);

        return redirect()->route('analisis-chse.index');
    }


    public function clean1()
    {
        return view('worker.analyst-chse.clean');
    }

    public function clean2()
    {
        return view('worker.analyst-chse.clean-2');
    }

    public function health1()
    {
        return view('worker.analyst-chse.health');
    }

    public function health2()
    {
        return view('worker.analyst-chse.health-2');
    }

    public function safety1()
    {
        return view('worker.analyst-chse.safety');
    }

    public function safety2()
    {
        return view('worker.analyst-chse.safety-2');
    }

    public function environment1()
    {
        return view('worker.analyst-chse.environment');
    }

    public function environment2()
    {
        return view('worker.analyst-chse.environment-2');
    }
}