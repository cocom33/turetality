<?php

namespace App\Http\Controllers\Worker;

use App\Exports\AnalystGizisExport;
use App\Http\Controllers\Controller;
use App\Models\AnalystGizi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HistoryGiziController extends Controller
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

        return view('worker.master-data.gizi.index', $data);
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

        $data = AnalystGizi::where('type', $request->type)
                    ->whereDate('created_at', '>=', $start)
                    ->whereDate('created_at', '<=', $end)
                    ->get();

        if($data->count() == 0) {
            return redirect()->back()->with('error', 'Tidak ada data pada tanggal tersebut');
        }

        return Excel::download(new AnalystGizisExport($data, $request->type), 'history-laporan-gizi-' . $request->name . ' ' . date('d-m-Y') . '.xlsx');
    }

    public function delete($id)
    {
        $data = AnalystGizi::find($id);

        if ($data->photo) {
            $this->file_delete($data->photo);
        }
        $data->delete();

        return redirect()->back()->with('', '');
    }

    public function breakfast()
    {
        $data['data'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'breakfast')->paginate(20);

        return view('worker.master-data.gizi.breakfast', $data);
    }

    public function launch()
    {
        $data['data'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'launch')->paginate(20);

        return view('worker.master-data.gizi.launch', $data);
    }

    public function dinner()
    {
        $data['data'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'dinner')->paginate(20);

        return view('worker.master-data.gizi.dinner', $data);
    }

    public function snack()
    {
        $data['data'] = AnalystGizi::where('user_id', auth()->user()->id)->where('type', 'snack')->paginate(20);

        return view('worker.master-data.gizi.snack', $data);
    }
}