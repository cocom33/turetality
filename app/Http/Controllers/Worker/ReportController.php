<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $data['report'] = Report::where('user_id', auth()->user()->id)->paginate(20);

        return view('worker.report.index', $data);
    }

    public function create()
    {
        return view('worker.report.create');
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
        $validate['user_id'] = auth()->user()->id;
        $validate['photo'] = $this->file_upload('/report', $request->photo);

        Report::create($validate);

        return redirect()->route('reports');
    }

    public function change($id)
    {
        $data = Report::find($id);
        $data->update([
            'status' => !$data->status
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $data = Report::find($id);
        if ($data->photo) {
            $this->file_delete($data->photo);
        }
        $data->delete();

        return redirect()->back();
    }
}