<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalystGizi;
use Illuminate\Http\Request;

class AnalystGiziController extends Controller
{
    public function index()
    {
        $data['morning'] = AnalystGizi::where('type', 'breakfast')->count();
        $data['launch'] = AnalystGizi::where('type', 'launch')->count();
        $data['dinner'] = AnalystGizi::where('type', 'dinner')->count();
        $data['snack'] = AnalystGizi::where('type', 'snack')->count();

        $last = AnalystGizi::select('type', 'user_id', 'created_at')->where('user_id', null)->orderBy('created_at', 'desc')->get();
        $data['lastM'] = $last->where('type', 'breakfast')->first();
        $data['lastL'] = $last->where('type', 'launch')->first();
        $data['lastD'] = $last->where('type', 'dinner')->first();
        $data['lastS'] = $last->where('type', 'snack')->first();

        return view('admin.analyst-gizi.index', $data);
    }

    public function morning()
    {
        return view('admin.analyst-gizi.morning');
    }

    public function noon()
    {
        return view('admin.analyst-gizi.noon');
    }

    public function night()
    {
        return view('admin.analyst-gizi.night');
    }

    public function snack()
    {
        return view('admin.analyst-gizi.snack');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'menu' => 'required|min:3',
            'asal' => 'required|min:3',
            'photo' => 'required|image',
            'date' => 'required',
            'catatan' => 'required',
            'type' => 'required',
        ]);

        $validate['photo'] = $this->file_upload('/analisis-gizi', $request->photo);

        AnalystGizi::create($validate);

        return redirect()->route('admin.analisis-gizi.index');
    }
}