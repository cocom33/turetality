<?php

namespace App\Exports;

use App\Models\AnalystChse;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AnalystChsesExport implements FromView
{
    protected $type;
    protected $data;

    public function __construct($data, $t){
        $this->data = $data;
        $this->type = $t;
    }

    public function view(): View
    {
        if ($this->type == 'clean') {
            $data['checklist'] = [
                '',
                "Apakah Pihak Hotel menyediakan \n SOP Kebersihan Lingkungan Kerja",
                "Adanya penggolongan tempat sampah"
            ];
        } else if ($this->type == 'health') {
            $data['checklist'] = [
                '',
                "Adanya SOP K3 di tempat kerja",
                "Adanya APAR di tempat kerja"
            ];
        } else if ($this->type == 'safety') {
            $data['checklist'] = [
                '',
                "Adanya jaminan kesehatan bagi pekerja",
                "Fasilitas pemeriksaan kesehatan bagi pekerja"
            ];
        } else if ($this->type == 'environment') {
            $data['checklist'] = [
                '',
                "Kondisi suhu yang normal",
                "kondisi penerangan cukup"
            ];
        }

        $data['result'] = $this->data;

        return view('admin.master-data.CHSE.export', $data);
    }
}