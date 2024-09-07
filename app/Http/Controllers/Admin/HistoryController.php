<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Imt;
use App\Models\UserHealth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function imt() {
        $data['imt'] = Imt::paginate(20);

        return view('admin.master-data.imt', $data);
    }

    public function worker() {
        $data['user'] = UserHealth::paginate(20);

        return view('admin.master-data.worker-health', $data);
    }
}
