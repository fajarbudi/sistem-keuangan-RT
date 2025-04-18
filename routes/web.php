<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaLelayu;
use App\Http\Controllers\BukuKas;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\data\Iuran;
use App\Http\Controllers\data\Notulensi;
use App\Http\Controllers\data\pengumuman;
use App\Http\Controllers\data\peraturan;
use App\Http\Controllers\data\Pertemuan;
use App\Http\Controllers\data\RekapSaldoKeluar;
use App\Http\Controllers\data\RekapSaldoMasuk;
use App\Http\Controllers\data\SaldoKeluar;
use App\Http\Controllers\data\SaldoMasuk;
use App\Http\Controllers\data\sop;
use App\Http\Controllers\data\tentang;
use App\Http\Controllers\dokumen\Cuti;
use App\Http\Controllers\dokumen\DiklatController;
use App\Http\Controllers\dokumen\KaryaSiswa;
use App\Http\Controllers\dokumen\KenaikanPangkat;
use App\Http\Controllers\dokumen\KGB;
use App\Http\Controllers\dokumen\Logbook;
use App\Http\Controllers\dokumen\LogbookHarian;
use App\Http\Controllers\dokumen\MonitoringLogbook;
use App\Http\Controllers\dokumen\mutasi;
use App\Http\Controllers\dokumen\PegawaiController;
use App\Http\Controllers\dokumen\Pengaduan;
use App\Http\Controllers\dokumen\Pensiun;
use App\Http\Controllers\dokumen\PenyesuaianGaji;
use App\Http\Controllers\dokumen\RekapDiklatKegiatan;
use App\Http\Controllers\dokumen\RekapDiklatPegawai;
use App\Http\Controllers\dokumen\RekapLogbook;
use App\Http\Controllers\referensi\Berkas;
use App\Http\Controllers\referensi\Bidang;
use App\Http\Controllers\referensi\Eselon;
use App\Http\Controllers\referensi\Gaji;
use App\Http\Controllers\referensi\Golongan;
use App\Http\Controllers\referensi\Jabatan;
use App\Http\Controllers\referensi\Jenis_iuran;
use App\Http\Controllers\referensi\Jenis_Jabatan;
use App\Http\Controllers\referensi\Jenis_kegiatan;
use App\Http\Controllers\referensi\Jenis_pengaduan;
use App\Http\Controllers\referensi\Jenis_saldo_keluar;
use App\Http\Controllers\referensi\Jenis_saldo_masuk;
use App\Http\Controllers\referensi\Jenis_uang;
use App\Http\Controllers\referensi\Kegiatan;
use App\Http\Controllers\referensi\Nominal;
use App\Http\Controllers\referensi\Pendidikan;
use App\Http\Controllers\referensi\Proses;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('isNotLogin')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front');
    Route::get('/auth', [AuthController::class, 'login'])->name('auth');
    Route::post('/login', [AuthController::class, 'goLogin']);
    Route::get('/viewRegister', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'goRegister']);
    // Route::get('/user/import', [UserController::class, 'import']);
});

Route::middleware('isLogin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/user/updateData/{id}', [UserController::class, 'updateData'])->name('user.update');
    Route::get('/user/update', [UserController::class, 'updateProfile']);

    //Warga
    Route::get('/warga', [PegawaiController::class, 'dataView']);
    Route::get('/warga/input', [PegawaiController::class, 'inp']);
    Route::post('/warga/foto', [PegawaiController::class, 'upFoto'])->name('warga.foto');
    Route::post('/warga/addData', [PegawaiController::class, 'addData'])->name('warga.add');
    Route::post('/warga/updateData/{id}', [PegawaiController::class, 'updateData'])->name('warga.update');
    Route::post('/warga/dellData/{id}', [PegawaiController::class, 'delData'])->name('warga.del');
    //referensi jenis saldo masuk
    Route::get('/referensi/jenis_uang', [Jenis_saldo_masuk::class, 'dataView'])->name('jenis_uang');
    Route::post('/referensi/jenis_uang/addData', [Jenis_saldo_masuk::class, 'addRefData'])->name('jenis_uang.add');
    Route::post('/referensi/jenis_uang/updateData/{id}', [Jenis_saldo_masuk::class, 'updateRefData'])->name('jenis_uang.update');
    Route::post('/referensi/jenis_uang/dellData/{id}', [Jenis_saldo_masuk::class, 'dellRefData']);
    //referensi jenis saldo keluar
    Route::get('/referensi/jenis_saldo_keluar', [Jenis_saldo_keluar::class, 'dataView'])->name('jenis_saldo_keluar');
    Route::post('/referensi/jenis_saldo_keluar/addData', [Jenis_saldo_keluar::class, 'addRefData'])->name('jenis_saldo_keluar.add');
    Route::post('/referensi/jenis_saldo_keluar/updateData/{id}', [Jenis_saldo_keluar::class, 'updateRefData'])->name('jenis_saldo_keluar.update');
    Route::post('/referensi/jenis_saldo_keluar/dellData/{id}', [Jenis_saldo_keluar::class, 'dellRefData']);
    //referensi iuran
    Route::get('/referensi/jenis_iuran', [Jenis_iuran::class, 'dataView'])->name('jenis_iuran');
    Route::post('/referensi/jenis_iuran/addData', [Jenis_iuran::class, 'addRefData'])->name('jenis_iuran.add');
    Route::post('/referensi/jenis_iuran/updateData/{id}', [Jenis_iuran::class, 'updateRefData'])->name('jenis_iuran.update');
    Route::post('/referensi/jenis_iuran/dellData/{id}', [Jenis_iuran::class, 'dellRefData']);
    //referensi iuran
    Route::get('/referensi/nominal', [Nominal::class, 'dataView'])->name('nominal');
    Route::post('/referensi/nominal/addData', [Nominal::class, 'addRefData'])->name('nominal.add');
    Route::post('/referensi/nominal/updateData/{id}', [Nominal::class, 'updateRefData'])->name('nominal.update');
    Route::post('/referensi/nominal/dellData/{id}', [Nominal::class, 'dellRefData']);

    //data sop
    Route::get('/data/sop', [sop::class, 'dataView'])->name('sop');
    Route::post('/data/sop/addData', [sop::class, 'addRefData'])->name('sop.add');
    Route::post('/data/sop/updateData/{id}', [sop::class, 'updateRefData'])->name('sop.update');
    Route::post('/data/sop/dellData/{id}', [sop::class, 'dellRefData']);
    //data peraturan
    Route::get('/data/peraturan', [peraturan::class, 'dataView'])->name('peraturan');
    Route::post('/data/peraturan/addData', [peraturan::class, 'addRefData'])->name('peraturan.add');
    Route::post('/data/peraturan/updateData/{id}', [peraturan::class, 'updateRefData'])->name('peraturan.update');
    Route::post('/data/peraturan/dellData/{id}', [peraturan::class, 'dellRefData']);
    //data pengumuman
    Route::get('/data/pengumuman', [pengumuman::class, 'dataView'])->name('pengumuman');
    Route::post('/data/pengumuman/addData', [pengumuman::class, 'addRefData'])->name('pengumuman.add');
    Route::post('/data/pengumuman/updateData/{id}', [pengumuman::class, 'updateRefData'])->name('pengumuman.update');
    Route::post('/data/pengumuman/dellData/{id}', [pengumuman::class, 'dellRefData']);
    //data tentang
    Route::get('/data/tentang', [tentang::class, 'dataView'])->name('tentang');
    Route::post('/data/tentang/addData', [tentang::class, 'addRefData'])->name('tentang.add');
    Route::post('/data/tentang/updateData/{id}', [tentang::class, 'updateRefData'])->name('tentang.update');
    Route::post('/data/tentang/dellData/{id}', [tentang::class, 'dellRefData']);


    //data saldo masuk
    Route::get('/data/saldo_masuk', [SaldoMasuk::class, 'dataView'])->name('saldo_masuk');
    Route::post('/data/saldo_masuk/addData', [SaldoMasuk::class, 'addRefData'])->name('saldo_masuk.add');
    Route::post('/data/saldo_masuk/updateData/{id}', [SaldoMasuk::class, 'updateRefData'])->name('saldo_masuk.update');
    Route::post('/data/saldo_masuk/dellData/{id}', [SaldoMasuk::class, 'dellRefData']);
    //data saldo keluar
    Route::get('/data/saldo_keluar', [SaldoKeluar::class, 'dataView'])->name('saldo_keluar');
    Route::post('/data/saldo_keluar/addData', [SaldoKeluar::class, 'addRefData'])->name('saldo_keluar.add');
    Route::post('/data/saldo_keluar/updateData/{id}', [SaldoKeluar::class, 'updateRefData'])->name('saldo_keluar.update');
    Route::post('/data/saldo_keluar/dellData/{id}', [SaldoKeluar::class, 'dellRefData']);
    //data pertemuan
    Route::get('/data/pertemuan', [Pertemuan::class, 'dataView'])->name('pertemuan');
    Route::post('/data/pertemuan/addData', [Pertemuan::class, 'addRefData'])->name('pertemuan.add');
    Route::post('/data/pertemuan/updateData/{id}', [Pertemuan::class, 'updateRefData'])->name('pertemuan.update');
    Route::post('/data/pertemuan/dellData/{id}', [Pertemuan::class, 'dellRefData']);
    //data Iuran
    Route::get('/data/iuran', [Iuran::class, 'dataView'])->name('iuran');
    Route::get('/data/iuran/detail/{id}', [Iuran::class, 'detail'])->name('iuran.detail');
    Route::post('/data/iuran/detail/add', [Iuran::class, 'addData'])->name('iuran.detail.add');
    Route::get('/data/iuran/data/{id}', [Iuran::class, 'data'])->name('iuran.data');
    Route::post('/data/iuran/updateData', [Iuran::class, 'updateData'])->name('iuran.update');
    Route::post('/data/iuran/selesai/{id}', [Iuran::class, 'selesai'])->name('iuran.selesai');
    Route::post('/data/iuran/buka_iuran/{id}', [Iuran::class, 'buka_iuran'])->name('iuran.buka_iuran');
    Route::get('/data/iuran/warga_view', [Iuran::class, 'iuranWarga'])->name('iuran.warga_view');
    //data Notulensi
    Route::get('/data/notulensi', [Notulensi::class, 'dataView'])->name('notulensi');
    Route::post('/data/notulensi/addData', [Notulensi::class, 'addRefData'])->name('notulensi.add');
    Route::post('/data/notulensi/updateData/{id}', [Notulensi::class, 'updateRefData'])->name('notulensi.update');
    Route::post('/data/notulensi/dellData/{id}', [Notulensi::class, 'dellRefData']);
    Route::get('/data/notulensi/detail/{id}', [Notulensi::class, 'detail'])->name('notulensi.detail');
    Route::post('/data/notulensi/detail/{notulensi_id}/addData', [Notulensi::class, 'addDetail'])->name('notulensi.detail.add');
    Route::post('/data/notulensi/detail/{notulensi_id}/updateData/{id}', [Notulensi::class, 'updateDetail'])->name('notulensi.detail.update');
    Route::post('/data/notulensi/detail/{notulensi_id}/dellData/{id}', [Notulensi::class, 'dellDetail']);
    //berita lelayu
    Route::get('/data/berita_lelayu', [BeritaLelayu::class, 'dataView'])->name('berita_lelayu');
    Route::post('/data/berita_lelayu/addData', [BeritaLelayu::class, 'addRefData'])->name('berita_lelayu.add');
    Route::post('/data/berita_lelayu/updateData/{id}', [BeritaLelayu::class, 'updateRefData'])->name('berita_lelayu.update');
    Route::post('/data/berita_lelayu/dellData/{id}', [BeritaLelayu::class, 'dellRefData']);
    Route::get('/data/berita_lelayu/detail/{id}', [BeritaLelayu::class, 'detail'])->name('berita_lelayu.detail');
    Route::post('/data/berita_lelayu/detail/{berita_lelayu_id}/addData', [BeritaLelayu::class, 'addDetail'])->name('berita_lelayu.detail.add');
    Route::post('/data/berita_lelayu/detail/{berita_lelayu_id}/updateData/{id}', [BeritaLelayu::class, 'updateDetail'])->name('berita_lelayu.detail.update');
    Route::post('/data/berita_lelayu/detail/{berita_lelayu_id}/dellData/{id}', [BeritaLelayu::class, 'dellDetail']);
    Route::get('/data/berita_lelayu/cetak/berita/{id}', [BeritaLelayu::class, 'c_berita'])->name('berita_lelayu.berita');
    Route::get('/data/berita_lelayu/cetak/banner/{id}', [BeritaLelayu::class, 'c_banner'])->name('berita_lelayu.banner');


    //Rekapitulasi Saldo Masuk
    Route::get('/rekapitulasi/saldo_masuk', [RekapSaldoMasuk::class, 'dataView'])->name('rekap_saldo_masuk');
    //Rekapitulasi Saldo Masuk
    Route::get('/rekapitulasi/saldo_keluar', [RekapSaldoKeluar::class, 'dataView'])->name('rekap_saldo_keluar');
    //Rekapitulasi Saldo Masuk
    Route::get('/rekapitulasi/buku_kas', [BukuKas::class, 'dataView'])->name('buku_kas');
});
