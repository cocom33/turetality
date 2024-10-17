<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\AnalystChse;
use App\Models\Answer;
use App\Models\QuestionForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalystChseController extends Controller
{
    public function index()
    {
        $data['clean'] = AnalystChse::where('type', 'clean')->count();
        $data['health'] = AnalystChse::where('type', 'health')->count();
        $data['safety'] = AnalystChse::where('type', 'safety')->count();
        $data['environment'] = AnalystChse::where('type', 'environment')->count();

        $answer = Answer::get();
        $data['cusclean'] = $answer->where('type', 'clean')->count();
        $data['cushealth'] = $answer->where('type', 'health')->count();
        $data['cussafety'] = $answer->where('type', 'safety')->count();
        $data['cusenvironment'] = $answer->where('type', 'environment')->count();

        $last = AnalystChse::select('type', 'user_id', 'created_at')->where('user_id', null)->orderBy('created_at', 'desc')->get();
        // dd($last);
        $data['lastC'] = $last->where('type', 'clean')->first();
        $data['lastH'] = $last->where('type', 'health')->first();
        $data['lastS'] = $last->where('type', 'safety')->first();
        $data['lastE'] = $last->where('type', 'environment')->first();

        return view('admin.analyst-chse.index', $data);
    }

    public function clean()
    {
        return view('admin.analyst-chse.clean');
    }

    public function health()
    {
        return view('admin.analyst-chse.health');
    }

    public function safety()
    {
        return view('admin.analyst-chse.safety');
    }

    public function environment()
    {
        return view('admin.analyst-chse.environment');
    }

    public function chseStore(Request $request)
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
                $satu['created_at'] = Carbon::create('now');
            } else {
                for ($j=0; $j < count($data); $j++) {
                    $dua[$data[$j]] = $request[$data[$j].$i];
                }
                if ($dua['photo'] != null) {
                    $dua['photo'] = $this->file_upload('/analisis-chse', $dua['photo']);
                }
                $dua['created_at'] = Carbon::create('now');
            }
        }

        DB::table('analyst_chses')->insert([$satu, $dua]);

        return redirect()->route('admin.analisis-chse.index')->with('success', 'berhasil membuat laporan baru');
    }

    public function addQuestion() {
        return view('admin.analyst-chse.question');
    }

    public function storeQuestion(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'chse' => 'required|in:clean,safety,health,environment',
            'question' => 'required',
            'type' => 'required',
        ]);

        if (count($request['type']) != count($request['question'])) {
            return redirect()->back()->with('error', 'silahkan masukkan data dengan benar')->withInput();
        }

        $add = Question::create([
            'type' => $data['chse'],
            'name' => $data['name'],
        ]);

        for ($i=0; $i < count($request['type']); $i++) {
            QuestionForm::create([
                'question_id' => $add->id,
                'type' => $request['type'][$i],
                'question' => $request['question'][$i],
            ]);
        }

        return redirect()->route('admin.analisis-chse.index')->with('success', 'berhasil membuat pertanyaan baru');
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

        return view('admin.analyst-chse.list', $data);
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

        return view('admin.analyst-chse.form', $data);
    }

    public function questionFormStore(Request $request, $type, $id) {
        $q = Answer::create([
            'type' => $type,
            'question_id' => $id
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

        return redirect()->route('admin.analisis-chse.index')->with('success', 'berhasil menambahkan laporan');
    }
}
