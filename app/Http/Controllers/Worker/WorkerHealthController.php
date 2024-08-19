<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserHealth;
use Illuminate\Http\Request;

class WorkerHealthController extends Controller
{
    public function index()
    {
        $data['user'] = UserHealth::where('user_id', auth()->user()->id)->paginate(20);

        return view('worker.worker-health.index', $data);
    }

    public function create()
    {
        return view('worker.worker-health.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'keluhan' => 'required',
            'hasil_pemeriksaan' => 'required',
            'catatan' => 'required',
            'photo' => 'required',
        ]);

        $validate['user_id'] = auth()->user()->id;
        $validate['photo'] = $this->file_upload('/worker-health', $request->photo);

        UserHealth::create($validate);

        return redirect()->route('worker-health');
    }

    public function delete($id)
    {
        $user = UserHealth::find($id);
        $this->file_delete($user->photo);
        $user->delete();

        return redirect()->back();
    }
}