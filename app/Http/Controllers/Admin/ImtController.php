<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ImtExport;
use App\Http\Controllers\Controller;
use App\Models\Imt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImtController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $data['search'] = $request->search;
            $data['imt'] = Imt::where('name', 'like', '%'.$request->search.'%')->paginate(20);
        } else {
            $data['imt'] = Imt::paginate(20);
        }

        return view('admin.imt.index', $data);
    }

    public function store(Request $request)
    {
        $request['hasil'] = (int)$request->hasil;
        Imt::create($request->all());

        return redirect()->back()->with('success', 'success added ');
    }

    public function delete($id)
    {
        $data = Imt::where('id', $id)->first();
        $data->delete();

        return redirect()->back()->with('success', 'success delete data');
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

        $data = Imt::whereDate('created_at', '>=', $start)
                    ->whereDate('created_at', '<=', $end)
                    ->get();

        if($data->count() == 0) {
            return redirect()->back()->with('error', 'Tidak ada data pada tanggal tersebut');
        }

        return Excel::download(new ImtExport($data, $request->type), 'history-imt ' . date('d-m-Y') . '.xlsx');
    }
}