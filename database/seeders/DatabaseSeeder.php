<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
        $posVal['user_nama'] = 'Administrator';
        $posVal['user_role'] = 'superAdmin';
        $posVal['user_email'] = 'admin@anauri.id';
        $posVal['user_username'] = 'admin';
        $posVal['user_jenis_kelamin'] = 'L';
        $posVal['password'] = 'admin';
        User::create($posVal);

        // $dataBapak = $this->dataBapak();

        // foreach ($dataBapak as $val) {
        //     $post = [];

        //     $post['user_nama'] = $val;
        //     $post['user_username'] = $val;
        //     $post['user_jenis_kelamin'] = 'L';
        //     $post['user_role'] = 'warga';
        //     $post['password'] = 12345;

        //     User::create($post);
        // }
    }

    private function dataBapak()
    {
        $data = [
            'Agus Sukarno',
            'Akhiriyanto',
            'Arif',
            'Affan',
            'Ario.S',
            'Agus.N',
            'Bambang.T',
            'Darohman',
            'Dwi/Rohmad',
            'Edi Purwanto',
            'Endro Aji',
            'Farros',
            'Fajar Ari',
            'Gito Kios',
            'Gondo',
            'Hendri Multi',
            'Heri.S',
            'Hendri.K',
            'Heru',
            'Iwan',
            'Joko Mulyono',
            'Kuswantoro',
            'Karsono',
            'Murjito',
            'Nando',
            'Ngadiono',
            'Parso',
            'Purwanto',
            'Paridi',
            'Rahmad',
            'Rinto',
            'Roni',
            'Rustam',
            'Sukarji',
            'Suryanto',
            'Sofiani',
            'Sugianto',
            'Sugiyarto',
            'WahyuWarih',
            'Sugiyanto',
            'Sakiran',
            'Sugito',
            'Suparjo',
            'Sarwani',
            'Wawan',
            'Yoko',
            'Yulianto',
            'Zainal',
            'Zaelani',
            'Wildan',
            'Heri.M',
            'Candra',
            'Huda',
            'Adi Septian',
            'Ringga',
            'Tata',
            'Haryo',
            'Bayu',
            'Aar',
            'Tri',
            'Iksan',
            'Wanto',
            'Gilang',
            'Ihsan',
            'Kukuh Mulyono',
            'Wasis',
            'Triono',
            'Rudi',
            'Hasnan',
            'Faisal',
            'Sendi',
            'Tugimin',
            'Eko/Atin',
            'Amir/Rika',
            'Endar',
            'Inggar',
            'Eko Ehasa',
            'Nina'
        ];

        return $data;
    }
}
