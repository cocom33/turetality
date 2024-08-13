<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserHealth;
use Illuminate\Http\Request;

class WorkerHealthController extends Controller
{
    public function index()
    {
        $data['user'] = UserHealth::paginate(20);

        return view('admin.worker-health.index', $data);
    }

    public function create()
    {
        $data['user'] = User::select('id', 'name')->get();

        return view('admin.worker-health.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required',
            'keluhan' => 'required',
            'hasil_pemeriksaan' => 'required',
            'catatan' => 'required',
            'photo' => 'required',
        ]);

        $validate['photo'] = $this->file_upload('/worker-health', $request->photo);

        UserHealth::create($validate);

        return redirect()->route('admin.worker-health');
    }

    public function delete($id)
    {
        $user = UserHealth::find($id);
        $this->file_delete($user->photo);
        $user->delete();

        return redirect()->back();
    }
}