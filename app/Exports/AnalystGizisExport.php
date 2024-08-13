<?php

namespace App\Exports;

use App\Models\AnalystGizi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AnalystGizisExport implements FromView
{
    protected $type;
    protected $data;

    public function __construct($data, $t){
        $this->data = $data;
        $this->type = $t;
    }

    public function view(): View
    {
        $data['result'] = $this->data;

        return view('admin.master-data.gizi.export', $data);
    }
}