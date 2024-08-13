<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\CallCenter;
use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    public function index()
    {
        $data['call'] = CallCenter::get();

        return view('worker.call-center.index', $data);
    }
}