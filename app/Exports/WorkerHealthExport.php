<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WorkerHealthExport implements FromView
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        $data['result'] = $this->data;

        return view('admin.worker-health.export', $data);
    }
}