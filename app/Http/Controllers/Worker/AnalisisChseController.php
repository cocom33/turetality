<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\AnalystChse;
use App\Models\Answer;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisisChseController extends Controller
{
    public function index()
    {
        $last = AnalystChse::select('type', 'user_id', 'created_at', 'number')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $data['clean'] = $last->where('type', 'clean')->count();
        $data['health'] = $last->where('type', 'health')->count();
        $data['safety'] = $last->where('type', 'safety')->count();
        $data['environment'] = $last->where('type', 'environment')->count();

        $data['lastC'] = $last->where('type', 'clean')->first();
        $data['lastH'] = $last->where('type', 'health')->first();
        $data['lastS'] = $last->where('type', 'safety')->first();
        $data['lastE'] = $last->where('type', 'environment')->first();

        return view('worker.analyst-chse.index', $data);
    }

    public function store(Request $request)
    {
        $data = ['number', 'type', 'check', 'place', 'catatan', 'photo'];

        for ($i=0; $i < 2; $i++) {
            if ($i == 0) {
                for ($j=0; $j < count($data); $j++) {
                    $satu[$data[$j]] = $request[$data[$j].$i];
                }
                if ($satu['photo'] != null) {
                    $satu['photo'] = $this->file_upload('/analisis-chse', $satu['photo']);
                }
                $satu['user_id'] = auth()->user()->id;
                $satu['created_at'] = Carbon::create('now');
            } else {
                for ($j=0; $j < count($data); $j++) {
                    $dua[$data[$j]] = $request[$data[$j].$i];
                }
                if ($dua['photo'] != null) {
                    $dua['photo'] = $this->file_upload('/analisis-chse', $dua['photo']);
                }
                $dua['user_id'] = auth()->user()->id;
                $dua['created_at'] = Carbon::create('now');
            }
        }

        DB::table('analyst_chses')->insert([$satu, $dua]);

        return redirect()->route('analisis-chse.index');
    }


    public function clean1()
    {
        return view('worker.analyst-chse.clean');
    }

    public function health1()
    {
        return view('worker.analyst-chse.health');
    }

    public function safety1()
    {
        return view('worker.analyst-chse.safety');
    }

    public function environment1()
    {
        return view('worker.analyst-chse.environment');
    }



    public function questionList($type) {
        $data['chse'] = Question::where('type', $type)->get();
        $data['title'] = 'History Laporan Tambahan untuk Analisis ';
        if ($type == 'clean') {
            $data['title'] .= 'Kebersihan';
        } elseif ($type == 'safety') {
            $data['title'] .= 'Keselamatan';
        } elseif ($type == 'environment') {
            $data['title'] .= 'Lingkungan';
        } else {
            $data['title'] .= 'Kesehatan';
        }

        return view('worker.analyst-chse.list', $data);
    }

    public function questionForm($type, $id) {
        $data['chse'] = Question::find($id);
        $data['title'] = 'Laporan Tambahan untuk Analisis ';
        if ($type == 'clean') {
            $data['title'] .= 'Kebersihan';
        } elseif ($type == 'safety') {
            $data['title'] .= 'Keselamatan';
        } elseif ($type == 'environment') {
            $data['title'] .= 'Lingkungan';
        } else {
            $data['title'] .= 'Kesehatan';
        }

        return view('worker.analyst-chse.form', $data);
    }

    public function questionFormStore(Request $request, $type, $id) {
        $q = Answer::create([
            'type' => $type,
            'question_id' => $id,
            'user_id' => auth()->user()->id
        ]);

        foreach ($request->all() as $key => $value) {
            if (is_numeric($key)) {
                if ($request->file($key)) {
                    $t = $this->file_upload('/analisis-chse', $request->file()[$key]);
                    $data[] = [
                        'answer_id' => $q->id,
                        'question_form_id' => $key,
                        'answer' => $t,
                    ];
                } else {
                    $data[] = [
                        'answer_id' => $q->id,
                        'question_form_id' => $key,
                        'answer' => $value,
                    ];
                }
            }
        }

        DB::table('answer_chses')->insert($data);

        return redirect()->route('analisis-chse.index')->with('success', 'berhasil menambahkan laporan');
    }
}
