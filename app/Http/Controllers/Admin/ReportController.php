<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $data['report'] = Report::paginate(20);

        return view('admin.report.index', $data);
    }

    public function create()
    {
        return view('admin.report.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'description' => 'required',
            'date' => 'required',
            'unit_kerja' => 'required',
            'catatan' => 'required',
            'photo' => 'required',
        ]);

        $validate['status'] = 0;
        $validate['photo'] = $this->file_upload('/report', $request->photo);

        Report::create($validate);

        return redirect()->route('admin.report')->with('success', 'berhasil membuat laporan');
    }

    public function change($id)
    {
        $data = Report::find($id);
        $data->update([
            'status' => !$data->status
        ]);

        return redirect()->back()->with('success', 'berhasil memperbarui laporan');
    }

    public function delete($id)
    {
        $user = Report::find($id);
        $this->file_delete($user->photo);
        $user->delete();

        return redirect()->back();
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

        $data = Report::whereDate('created_at', '>=', $start)
                        ->whereDate('created_at', '<=', $end)
                        ->get();

        if($data->count() == 0) {
            return redirect()->back()->with('error', 'Tidak ada data pada tanggal tersebut');
        }

        return Excel::download(new ReportExport($data), 'history-report ' . date('d-m-Y') . '.xlsx');
    }
}
