<?php

namespace App\Http\Controllers\Worker;

use App\Exports\AnalystChsesExport;
use App\Http\Controllers\Controller;
use App\Models\AnalystChse;
use App\Models\Answer;
use App\Models\AnswerChse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HistoryChseController extends Controller
{
    public function index()
    {
        $last = AnalystChse::select('type', 'user_id', 'created_at')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $data['clean'] = $last->where('type', 'clean')->count();
        $data['health'] = $last->where('type', 'health')->count();
        $data['safety'] = $last->where('type', 'safety')->count();
        $data['environment'] = $last->where('type', 'environment')->count();

        // dd($last);
        $data['lastC'] = $last->where('type', 'clean')->first();
        $data['lastH'] = $last->where('type', 'health')->first();
        $data['lastS'] = $last->where('type', 'safety')->first();
        $data['lastE'] = $last->where('type', 'environment')->first();

        $answer = Answer::where('user_id', auth()->user()->id)->get();
        $data['cusclean'] = $answer->where('type', 'clean')->count();
        $data['cushealth'] = $answer->where('type', 'health')->count();
        $data['cussafety'] = $answer->where('type', 'safety')->count();
        $data['cusenvironment'] = $answer->where('type', 'environment')->count();

        return view('worker.master-data.CHSE.index', $data);
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

        $data = AnalystChse::where('type', $request->type)
                    ->whereDate('created_at', '>=', $start)
                    ->whereDate('created_at', '<=', $end)
                    ->get();

        if($data->count() == 0) {
            return redirect()->back()->with('error', 'Tidak ada data pada tanggal tersebut');
        }

        return Excel::download(new AnalystChsesExport($data, $request->type), 'history-analisis-chse-bagian-' . $request->name . ' ' . date('d-m-Y') . '.xlsx');
    }

    public function delete($id)
    {
        $data = AnalystChse::find($id);

        if ($data->photo) {
            $this->file_delete($data->photo);
        }
        $data->delete();

        return redirect()->back()->with('', '');
    }

    public function clean()
    {
        $data['data'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'clean')->paginate(20);

        return view('worker.master-data.CHSE.clean', $data);
    }

    public function safety()
    {
        $data['data'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'safety')->paginate(20);

        return view('worker.master-data.CHSE.safety', $data);
    }

    public function health()
    {
        $data['data'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'health')->paginate(20);

        return view('worker.master-data.CHSE.health', $data);
    }

    public function environment()
    {
        $data['data'] = AnalystChse::where('user_id', auth()->user()->id)->where('type', 'environment')->paginate(20);

        return view('worker.master-data.CHSE.environment', $data);
    }

    public function custom($type)
    {
        $data['data'] = Answer::with('question', 'answer', 'answer.question_form')->where('user_id', auth()->user()->id)->where('type', $type)->paginate(20);
        $data['title'] = 'Laporan Tambahan untuk ';
        if ($type == 'clean') {
            $data['title'] .= 'Kebersihan';
        } elseif ($type == 'safety') {
            $data['title'] .= 'Keselamatan';
        } elseif ($type == 'environment') {
            $data['title'] .= 'Lingkungan';
        } else {
            $data['title'] .= 'Kesehatan';
        }

        return view('worker.master-data.CHSE.custom', $data);
    }

    public function customDelete($id) {
        $a = Answer::find($id);
        $q = AnswerChse::where('answer_id', $a->id)->get();

        foreach ($q as $value) {
            if ($value->question_form->type == 'image') {
                $this->file_delete($value->answer);
            }
            $value->delete();
        }
        $a->delete();

        return redirect()->back()->with('success', 'berhasil menghapus laporan');
    }
}
