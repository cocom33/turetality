<?php

namespace App\Http\Controllers\Admin;

use App\Exports\WorkerHealthExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserHealth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            'recomendation' => 'sometimes',
        ]);

        $validate['photo'] = $this->file_upload('/worker-health', $request->photo);

        UserHealth::create($validate);

        return redirect()->route('admin.worker-health')->with('success', 'berhasil membuat laporan kesehatan pekerja');
    }

    public function delete($id)
    {
        $user = UserHealth::find($id);
        $this->file_delete($user->photo);
        $user->delete();

        return redirect()->back();
    }

    public function recomendation(Request $request, $id)
    {
        $request->validate(['recomendation' => 'required']);

        $user = UserHealth::find($id);
        $user->update([
            'recomendation' => $request->recomendation
        ]);

        return redirect()->back()->with('success', 'berhasil menambahkan rekomendasi');
    }

    public function export(Request $request)
    {
        if ($request->date == 'now') {
            $start = Carbon::create($request->date)->format('Y-m-d');
            $end = Carbon::create($request->date)->format('Y-m-d');
        } else {
            $d = explode('-', $request->date);

            $start = Carbon::create($d[0])->format('Y-m-d');
            $end = Carbon::create($d[1])->format('Y-m-d');
        }

        $data = UserHealth::whereDate('created_at', '>=', $start)
                    ->whereDate('created_at', '<=', $end)
                    ->get();

        if($data->count() == 0) {
            return redirect()->back()->with('error', 'Tidak ada data pada tanggal tersebut');
        }

        return Excel::download(new WorkerHealthExport($data, $request->type), 'worker-health ' . date('d-m-Y') . '.xlsx');
    }
}
