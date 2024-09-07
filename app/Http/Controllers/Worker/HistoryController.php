<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Imt;
use App\Models\UserHealth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function imt() {
        $data['imt'] = Imt::where('user_id', auth()->user()->id)->paginate(20);

        return view('worker.master-data.imt', $data);
    }

    public function worker() {
        $data['user'] = UserHealth::where('user_id', auth()->user()->id)->paginate(20);

        return view('worker.master-data.worker-health', $data);
    }
}