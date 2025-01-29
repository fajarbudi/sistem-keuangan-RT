<?php

namespace App\Imports;

use App\Models\dokumen\pegawai as DokumenPegawai;
use App\Models\pegawai;
use App\Models\referensi\ref_jabatan;
use App\Models\referensi\ref_pendidikan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    // /**
    //  * @var BookedVoucher 
    //  */
    // protected $bookedVoucher;

    // /**
    //  * @param BookedVoucher $bookedVoucher
    //  */
    // public function __construct(User $bookedVoucher)
    // {
    //     $this->bookedVoucher = $bookedVoucher;
    // }

    public function model(array $row)
    {
        $jabatan = ref_jabatan::where('jabatan_nama', $row[4])->first();
        $pendidikan = ref_pendidikan::where('pendidikan_nama', $row[4])->first();
        return new DokumenPegawai([
            'pegawai_nama'     => $row[1],
            'pegawai_nip' => $row[2],
            'jabatan_id' => $jabatan->jabatan_id ?? null,
            'pendidikan_id' => $pendidikan->pendidikan_id ?? null,
            'pegawai_jurusan' => $row[7]
        ]);

        // return new User([
        //     'user_nama'     => $row[1],
        //     'user_username' => $row[2],
        //     'pegawai_id' => $row[0],
        //     'user_email' => null,
        //     'user_role' => 'user',
        //     'password' => 12345,
        // ]);
    }
}
