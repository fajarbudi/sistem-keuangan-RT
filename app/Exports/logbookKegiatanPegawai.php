<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class logbookKegiatanPegawai implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data  = $data;
    }

    public function View(): View
    {
        return view('export.logbook_kegiatan_pegawai', [
            'datas' => $this->data,
        ]);
    }
}
