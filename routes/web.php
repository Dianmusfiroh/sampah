<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Report;
use App\Http\Controllers\SendNotifikasiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoguserController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\SettingXenditController;
use App\Http\Controllers\settingCustomController;
use App\Http\Controllers\FitturController;
use App\Http\Controllers\TargetController;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// get index
Route::get('/template', [TemplateController::class, 'index']);
Route::get('/template', [TemplateController::class, 'detail']);
Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/beranda', [HomeController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/order', [OrderController::class, 'index']);
Route::get('/seller', [SellerController::class, 'index']);
Route::resource('akun', AkunController::class);
Route::resource('logUser', LoguserController::class);
Route::resource('SendNotification', SendNotifikasiController::class);
// Route::resource('report', Report::class);
Route::get('statistikPengirim', [StatistikController::class,'statistikPengirim'])->name('statistikPengirim');
Route::get('statistikMember', [StatistikController::class,'statistikMember'])->name('statistikMember');
Route::get('statistikJenisUsaha', [StatistikController::class,'statistikJenisUsaha'])->name('statistikJenisUsaha');
Route::resource('statistik', StatistikController::class);
Route::post('storeAkun', [Report::class,'storeAkun'])->name('storeAkun');
Route::get('updateStatus',[SettingXenditController::class,'updateStatus'])->name('updateStatus');
Route::get('updateStatusCustom',[settingCustomController::class,'updateStatusCustom'])->name('updateStatusCustom');
Route::get('get_Pemesanan',[StatistikController::class,'get_Pemesanan'])->name('get_Pemesanan');
Route::get('get_Dikirim',[StatistikController::class,'get_Dikirim'])->name('get_Dikirim');
Route::get('get_Selesai',[StatistikController::class,'get_Selesai'])->name('get_Selesai');
Route::get('get_data',[Report::class,'get_data'])->name('get_data');
Route::get('getDate',[StatistikController::class,'getDate'])->name('getDate');
Route::get('anotherFunction',[StatistikController::class,'anotherFunction'])->name('anotherFunction');
Route::get('postTable',[StatistikController::class,'postTable'])->name('postTable');
Route::get('get_Chart_Pemesanan',[StatistikController::class,'get_Chart_Pemesanan'])->name('get_Chart_Pemesanan');
Route::get('getDetailTransaksiUser/{id_user} ',[StatistikController::class,'getDetailTransaksiUser'])->name('getDetailTransaksiUser');
Route::get('getDetailDikirim',[StatistikController::class,'getDetailDikirim'])->name('getDetailDikirim');


Route::get('get_dataTotal',[Report::class,'get_dataTotal'])->name('get_dataTotal');
// Route::put('resetPin',[SettingXenditController::class,'resetPin'])->name('resetPin');
Route::resource('resetPin',SettingXenditController::class);
// Route::get('resetPin',[SettingXenditController::class,'reset'])->name('reset');
Route::get('userAktif',[AkunController::class,'userAktif'])->name('userAktif');
Route::get('produkTerbaik',[Report::class,'topProduk'])->name('topProduk');
Route::get('report',[Report::class,'index'])->name('report');
Route::get('searchReport',[Report::class,'search'])->name('search');
Route::get('reportAkun',[Report::class,'reportAkun'])->name('reportAkun');
Route::post('/login', [LoginController::class, 'log']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/cetakUserAktif', [Report::class, 'cetakAktif_pdf'])->name('cetakAktif');
Route::get('/cetakUserTidakAktif', [Report::class, 'cetakTidakAktif_pdf'])->name('cetakNonAktif');
Route::resource('kategori', KategoriController::class);
Route::resource('tutorial', TutorialController::class);
Route::resource('settingCustom', settingCustomController::class);
Route::resource('fittur', FitturController::class);
Route::resource('target', TargetController::class);
Route::get('data',[AkunController::class,'data'])->name('data');
Route::get('detailHari',[HomeController::class,'detailDay'])->name('detailDay');
Route::get('detailNominalTahun',[HomeController::class,'detailTahunNominal'])->name('detailTahunNominal');
Route::get('detailTotalTahun',[HomeController::class,'detailTotalTahun'])->name('detailTotalTahun');
Route::get('detailPendaftaranTahun',[HomeController::class,'detailPendaftaranTahun'])->name('detailPendaftaranTahun');
Route::get('detailAkunTotal',[HomeController::class,'detailAkunTotal'])->name('detailAkunTotal');
Route::get('detailPendaftaranBulanKemarin',[HomeController::class,'detailPendaftaranBulanKemarin'])->name('detailPendaftaranBulanKemarin');
Route::get('detailTransaksiBulanLalu',[HomeController::class,'detailTransaksiBulanLalu'])->name('detailTransaksiBulanLalu');
Route::get('detailBulanLaluNominal',[HomeController::class,'detailBulanLaluNominal'])->name('detailBulanLaluNominal');
Route::get('detailPendaftaranBulan',[HomeController::class,'detailPendaftaranBulan'])->name('detailPendaftaranBulan');
Route::get('detailTransaksiBulan',[HomeController::class,'detailTransaksiBulan'])->name('detailTransaksiBulan');
Route::get('detailBulanNominal',[HomeController::class,'detailBulanNominal'])->name('detailBulanNominal');
Route::get('detailPendaftaranKemarin',[HomeController::class,'detailPendaftaranKemarin'])->name('detailPendaftaranKemarin');
Route::get('detailTransaksiKemarin',[HomeController::class,'detailTransaksiKemarin'])->name('detailTransaksiKemarin');
Route::get('detailKemarinNominal',[HomeController::class,'detailKemarinNominal'])->name('detailKemarinNominal');
Route::get('detailPendaftaranHariIni',[HomeController::class,'detailPendaftaranHariIni'])->name('detailPendaftaranHariIni');
Route::get('detailTransaksiHariIni',[HomeController::class,'detailTransaksiHariIni'])->name('detailTransaksiHariIni');
Route::get('detailHariIniNominal',[HomeController::class,'detailHariIniNominal'])->name('detailHariIniNominal');
Route::post('/sendNotif', [App\Http\Controllers\SendNotifikasiController::class, 'sendNotif'])->name('sendNotif');
Route::get('/sendNotifikasi/{id_log_notif}', [App\Http\Controllers\SendNotifikasiController::class, 'sendNotifA'])->name('sendNotifA');
Route::get('/detailSellByToko/{id_user}',[Report::class,'detailSellByToko'])->name('detailSellByToko');
Route::get('/detailSellByProduk/{id_user}',[Report::class,'detailSellByProduk'])->name('detailSellByProduk');
Route::post('/detailSellByToko/',[Report::class,'detailSellByToko'])->name('postdetailSellByToko');
Route::get('/viewmemberkab',[StatistikController::class,'memberViewKab'])->name('memberViewKab');
Route::get('/rajaOngkirKab/{cityId}',[StatistikController::class,'rajaOngkirKabupaten'])->name('rajaOngkirKabupaten');
Route::get('/rajaOngkirProv/{provId}',[StatistikController::class,'rajaOngkirProvinsi'])->name('rajaOngkirProvinsi');
Route::get('/getProvince',[StatistikController::class,'getProvince'])->name('getProvince');
Route::get('/getKabupaten',[StatistikController::class,'getKabupaten'])->name('getKabupaten');
Route::get('/getDetailStatistikJenisUsaha',[StatistikController::class,'getDetailStatistikJenisUsaha'])->name('getDetailStatistikJenisUsaha');
Route::get('/getDataTransaksi',[StatistikController::class,'getDataTransaksi'])->name('getDataTransaksi');
Route::get('/getStudents',[StatistikController::class,'getStudents'])->name('getStudents');
Route::get('/getDetailSelesai',[StatistikController::class,'getDetailSelesai'])->name('getDetailSelesai');
Route::get('/getDetailPemesanan',[StatistikController::class,'getDetailPemesanan'])->name('getDetailPemesanan');
Route::get('/getDetailTotalSelesai',[StatistikController::class,'getDetailTotalSelesai'])->name('getDetailTotalSelesai');
Route::get('/getDetailTotalDikirim',[StatistikController::class,'getDetailTotalDikirim'])->name('getDetailTotalDikirim');
Route::get('/getDetailTotalPesanan',[StatistikController::class,'getDetailTotalPesanan'])->name('getDetailTotalPesanan');
Route::get('/getDataTarget',[HomeController::class,'getDataTarget'])->name('getDataTarget');
Route::get('/getakunTidakAktif',[AkunController::class,'akunTidakAktif'])->name('akunTidakAktif');
Route::get('/akunTidakAktif',[AkunController::class,'V_akunTidakAktif'])->name('V_akunTidakAktif');
Route::get('/simpanDataHistoryTarget',[HomeController::class,'simpanDataHistoryTarget'])->name('simpanDataHistoryTarget');
Route::get('/getDataTransaksiSukses',[HomeController::class,'getDataTransaksiSukses'])->name('getDataTransaksiSukses');
Route::get('/getDataPendaftaran',[HomeController::class,'getDataPendaftaran'])->name('getDataPendaftaran');
Route::get('/getDataNominalTransaksi',[HomeController::class,'getDataNominalTransaksi'])->name('getDataNominalTransaksi');
Route::get('/getDetailStatistikPengirim',[StatistikController::class,'getDetailStatistikPengirim'])->name('getDetailStatistikPengirim');


