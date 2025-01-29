<?php

namespace App\Exports;

use App\Models\diklat;
use App\Models\dokumen\diklat as DokumenDiklat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DiklatPegawai implements FromView
{

    private $data;

    public function __construct($data)
    {
        $this->data  = $data;
    }

    public function View(): View
    {
        return view('export.diklat_pegawai', [
            'datas' => $this->data
        ]);
    }
}
