<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        $data['result'] = $this->data;

        return view('admin.report.export', $data);
    }
}