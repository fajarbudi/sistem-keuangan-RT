<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class logbookPegawaiHarian implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data  = $data;
    }

    public function View(): View
    {
        return view('export.logbook_pegawai_harian', [
            'datas' => $this->data,
        ]);
    }
}
