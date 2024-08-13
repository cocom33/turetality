<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\AnalystGizi;
use Illuminate\Http\Request;

class AnalisisGiziController extends Controller
{
    public function index()
    {
        $last = AnalystGizi::select('type', 'user_id', 'created_at')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $data['morning'] = $last->where('type', 'breakfast')->count();
        $data['launch'] = $last->where('type', 'launch')->count();
        $data['dinner'] = $last->where('type', 'dinner')->count();
        $data['snack'] = $last->where('type', 'snack')->count();

        $data['lastM'] = $last->where('type', 'breakfast')->first();
        $data['lastL'] = $last->where('type', 'launch')->first();
        $data['lastD'] = $last->where('type', 'dinner')->first();
        $data['lastS'] = $last->where('type', 'snack')->first();

        return view('worker.analyst-gizi.index', $data);
    }

    public function store(Request $request)
    {
        // dd('te');
        $validate = $request->validate([
            'type' => 'required',
            'menu' => 'required',
            'asal' => 'required',
            'photo' => 'sometimes',
            'date' => 'required',
            'catatan' => 'required',
        ]);

        $validate['user_id'] = auth()->user()->id;

        if ($request->photo) {
            $validate['photo'] = $this->file_upload('/analisis-gizi', $request->photo);
        }

        AnalystGizi::create($validate);

        return redirect()->route('analisis-gizi.index');
    }

    public function breakfast()
    {
        return view('worker.analyst-gizi.morning');
    }

    public function launch()
    {
        return view('worker.analyst-gizi.noon');
    }

    public function dinner()
    {
        return view('worker.analyst-gizi.night');
    }

    public function snack()
    {
        return view('worker.analyst-gizi.snack');
    }
}