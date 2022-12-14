<?php

namespace App\Http\Controllers;

use App\Models\HistoryTarget;
use Illuminate\Http\Request;
use App\Models\tUser;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Models;
use App\Models\Target;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class HomeController extends Controller
{
    public function index(Request $request){

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        //Lastmonth
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        //endlastMonth
        //chart
        $chrtExp = '';
        $orderUser = '';
        $user = DB::select(DB::raw('SELECT COUNT(id_user) AS jumlah, is_created FROM t_user WHERE year(is_created)= year(NOW())  GROUP BY month(is_created)'));
        $userExp = DB::select(DB::raw('SELECT COUNT(id_user) AS jumlah, tgl_expired FROM t_user WHERE year(tgl_expired)= year(NOW())  GROUP BY month(tgl_expired)'));
        foreach ($userExp as $item) {
            $chrtExp .= $item->jumlah.',';
            $chrtExp .= $item->jumlah.',';
        }
        foreach ($user as $item) {
            $orderUser .= $item->jumlah.',';
        }


        //endChart
        $totalUser =  tUser::whereIn('produk_id',['198','175'])->count();
        $userA=  DB::select(DB::raw('select count(id_user) as total,produk_id, tgl_expired, current_date() as tgl_sekarang,datediff(tgl_expired, current_date()) as selisih from t_user WHERE produk_id IN (175,198) and tgl_expired >= CURRENT_DATE()'));
        //targetHari
        $userToDay= DB::table('t_user')->whereDate('is_created',$now)->count('id_user');
        $totalTransaksiHariSukses = DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order');
        $NominalTransaksiHariSukses = DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar');


        $target = Target::get();
        $nowMonth = Carbon::now()->format('m');
        $hitungHariDiBulan = cal_days_in_month(CAL_GREGORIAN,$nowMonth, date('y'));
        $weekInMonth = $hitungHariDiBulan / 7;
        // $hasilBulan = $target[0]->bulan /$hitungHariDiBulan ;
        // target hariini dan kemarin
        $targetPendaftaranTahun =0;
        $targetTransaksiTahun =0;
        $targetNominalTahun =0;
        // $targetNominal = 0;
        foreach ($target as $item ) {
            //target tahun
            if ($item->tahun == Carbon::now()->format('Y')) {
                $targetPendaftaranTahun += $item->pendaftaran;
                $targetTransaksiTahun += $item->transaksi;
                $targetNominalTahun += $item->nominal;
            }
            // target bulan
            $targetPendaftaranBulan = $item->pendaftaran;
            $targetTransaksiBulan = $item->transaksi;
            $targetNominalBulan = $item->nominal;


            // target hari
            if ($item->bulan == 'januari' && $nowMonth == '01') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'februari' && $nowMonth == '02') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'maret' && $nowMonth == '03') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'april' && $nowMonth == '04') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'mei' && $nowMonth == '05') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'juni' && $nowMonth == '06') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'juli' && $nowMonth == '07') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'agustus' && $nowMonth == '08') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'september' && $nowMonth == '09') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'oktober' && $nowMonth == '10') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'november' && $nowMonth == '11') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
            }else if ($item->bulan == 'desember' && $nowMonth == '12') {
                $targetNominal =  $item->nominal / $hitungHariDiBulan;
                $targetPendaftaran =  $item->pendaftaran / $hitungHariDiBulan;
                $targetTransaksi =  $item->transaksi / $hitungHariDiBulan;
                dd($targetNominal);
            
            }

        }
        // Persentse Target
        $data = [
            'view' => 'v_home2',
            'data' =>
            [

                'label' => 'Dashboard',
                'user'=>  tUser::whereIn('produk_id',['198','175']),
                'produk'=> Produk::all(),
                'bestProduk' => DB::select('SELECT p.id_user,t.id_produk ,p.nama_produk,p.gambar ,sum(total) as jumlah, pl.link from ( SELECT a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM t_keranjang k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status="4") AS a GROUP BY a.id_produk UNION ALL SELECT id_produk,COUNT(id_produk) AS total FROM t_order o WHERE order_status="4" GROUP BY id_produk) AS t JOIN t_produk p JOIN t_produk_link pl WHERE pl.id_produk = t.id_produk AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5'),
                'userA'=>  DB::select(DB::raw('select
                count(id_user) as total,produk_id, tgl_expired, current_date() as tgl_sekarang,datediff(tgl_expired, current_date()) as selisih from t_user WHERE produk_id IN (175,198) and tgl_expired >= CURRENT_DATE()')),
                //Day
                'userToDay'=> DB::table('t_user')->whereDate('is_created',$now)->count('id_user'),
                'totalTransaksiHari' => DB::table('t_order')->whereDate('tgl_order',$now)->count('id_order')+ DB::table('t_multi_order')->whereDate('tgl_order',$now)->count('id_order'),
                'totalTransaksiHariSukses' => $totalTransaksiHariSukses,
                'NominalTransaksiHariSukses' => $NominalTransaksiHariSukses,
                //Yesterday
                'userYesterday'=> DB::table('t_user')->whereDate('is_created',$yesterday)->count('id_user'),
                'totalTransaksiYesterday' => DB::table('t_order')->whereDate('tgl_order',$yesterday)->count('id_order')+ DB::table('t_multi_order')->whereDate('tgl_order',$yesterday)->count('id_order'),
                'totalTransaksiYesterdaySukses' => DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$yesterday)->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$yesterday)->count('id_order'),
                'NominalTransaksiYesterdaySukses' => DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$yesterday)->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$yesterday)->sum('totalbayar'),
                //Month
                'userMonth'=> DB::table('t_user')->whereYear('is_created',$year)->whereMonth('is_created',Carbon::now()->format('m'))->count('id_user'),
                'totalTransaksiMonth' => DB::table('t_order')->whereYear('is_created',$year)->whereMonth('is_created',Carbon::now()->format('m'))->count('id_order')+ DB::table('t_multi_order')->whereYear('is_created',$year)->whereMonth('is_created',Carbon::now()->format('m'))->count('id_order'),
                'totalTransaksiMonthSukses' => DB::table('t_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',Carbon::now()->format('m'))->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',Carbon::now()->format('m'))->count('id_order'),
                'NominalTransaksiMonthSukses' => DB::table('t_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',Carbon::now()->format('m'))->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',Carbon::now()->format('m'))->sum('totalbayar'),
                //LastMonth
                'userLastMonth'=> DB::table('t_user')->whereYear('is_created',$year)->whereMonth('is_created',$lastMonth)->count('id_user'),
                'totalTransaksiLastMonth' => DB::table('t_order')->whereYear('is_created',$year)->whereMonth('is_created',$lastMonth)->count('id_order')+ DB::table('t_multi_order')->whereYear('is_created',$year)->whereMonth('is_created',$lastMonth)->count('id_order'),
                'totalTransaksiLastMonthSukses' => DB::table('t_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',$lastMonth)->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',$lastMonth)->count('id_order'),
                'NominalTransaksiLastMonthSukses' => DB::table('t_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',$lastMonth)->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereYear('is_created',$year)->whereMonth('is_created',$lastMonth)->sum('totalbayar'),
                //Year
                'userYear'=> DB::table('t_user')->whereYear('is_created',$year)->count('id_user'),
                'totalTransaksiYear' => DB::table('t_order')->whereYear('is_created',$year)->count('id_order')+ DB::table('t_multi_order')->whereYear('is_created',$year)->count('id_order'),
                'totalTransaksiYearSukses' => DB::table('t_order')->where('order_status','4')->whereYear('is_created',$year)->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereYear('is_created',$year)->count('id_order'),
                'NominalTransaksiYearSukses' => DB::table('t_order')->where('order_status','4')->whereYear('is_created',$year)->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereYear('is_created',$year)->sum('totalbayar'),

                //chart
                'chartUser' => $orderUser ,
                'chart'=> $chrtExp,
                'targetPengguna' => $userA[0]->total / $totalUser *100,
                // 'targetNominal' => $targetNominal,
                // 'targetPendaftaran' => $targetPendaftaran,
                // 'targetTransaksi' => $targetTransaksi,
                // 'targetPendaftaranBulan' => $targetPendaftaranBulan,
                // 'targetTransaksiBulan' => $targetTransaksiBulan,
                // 'targetNominalBulan' => $targetNominalBulan,
                // 'targetPendaftaranTahun' => $targetPendaftaranTahun,
                // 'targetTransaksiTahun' =>$targetTransaksiTahun,
                // 'targetNominalTahun' =>$targetNominalTahun,
                ]
            ];
        return backend($request,$data);
    }
    // public function detailDay(Request $request)
    // {
    //     $data = [
    //         'view' => 'detail.detailDay',
    //         'data' => 
    //         [
    //             'label' => 'Detaill Hari Ini',
    //             'user'=>  tUser::whereIn('produk_id',['198','175']),
    //             'produk'=> Produk::all(),
    //             'bestProduk' => DB::select('SELECT p.id_user,t.id_produk ,p.nama_produk,p.gambar ,sum(total) as jumlah, pl.link from ( SELECT a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM t_keranjang k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status="4") AS a GROUP BY a.id_produk UNION ALL SELECT id_produk,COUNT(id_produk) AS total FROM t_order o WHERE order_status="4" GROUP BY id_produk) AS t JOIN t_produk p JOIN t_produk_link pl WHERE pl.id_produk = t.id_produk AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5'),
    //             'userA'=>  DB::select(DB::raw('select
    //             count(id_user) as total,produk_id, tgl_expired, current_date() as tgl_sekarang,datediff(tgl_expired, current_date()) as selisih from t_user WHERE produk_id IN (175,198) and tgl_expired >= CURRENT_DATE()')),
    //             // //Day
    //             // 'userToDay'=> DB::table('t_user')->whereDate('is_created',$now)->count('id_user'),
    //             // 'totalTransaksiHari' => DB::table('t_order')->whereDate('tgl_order',$now)->count('id_order')+ DB::table('t_multi_order')->whereDate('tgl_order',$now)->count('id_order'),
    //             // 'totalTransaksiHariSukses' => DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order'),
    //             // 'NominalTransaksiHariSukses' => DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar'),
    //             // //chart
    //             // 'chartUser' => $orderUser ,
    //             // 'chart'=> $chrtExp
    //             ]
    //         ];
    //     return backend($request,$data);
    // }
    public function detailTahunNominal(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailYearNominal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Sukses Tahun Ini',
                'totalTransaksiYearSukses' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND year(is_created) = year(now()) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND o.order_status = '4' AND year(o.is_created) = year(now())) AS a"),
            ]
            ];
        return backend($request,$data);
    }
    public function detailTotalTahun(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailYearTotal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Tahun Ini',
                'totalTransaksiYear' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang  AND year(is_created) = year(now()) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND  year(o.is_created) = year(now())) AS a"),
            ]
            ];
        return backend($request,$data);
    }
    public function detailPendaftaranTahun(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailPendaftaranTahun',
            'data' =>
            [
                'label' => 'Detaill Pendaftaran Tahun Ini',
                'totalPendaftaranYear' => DB::select("SELECT u.nama_lengkap,u.is_created,u.produk_id, s.nama_toko, u.email,u.no_hp , u.alamat FROM t_user u, t_setting s WHERE u.id_user = s.id_user AND year(is_created) = year(now()) AND u.produk_id = '198' OR u.produk_id = '175' AND s.id_user = u.id_user GROUP BY u.id_user;"),
            ]
            ];
        return backend($request,$data);
    }
    // select u.id_user ,u.nama_lengkap, s.nama_toko,u.email,u.no_hp,u.alamat,u.produk_id from t_user u ,t_setting s WHERE u.produk_id IN (175,198) and u.tgl_expired >= CURRENT_DATE() GROUP BY u.id_user;
    public function detailAkunTotal(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailTotalUser',
            'data' =>
            [
                'label' => 'Detaill User Aktif',
                'totalPendaftaranYear' => DB::select("SELECT u.nama_lengkap,u.is_created,u.produk_id, s.nama_toko, u.email,u.no_hp , u.alamat FROM t_user u, t_setting s WHERE u.id_user = s.id_user AND year(is_created) = year(now()) AND u.produk_id = '198' OR u.produk_id = '175' AND s.id_user = u.id_user GROUP BY u.id_user;"),
            ]
            ];
        return backend($request,$data);
    }
    public function detailPendaftaranBulanKemarin(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailPendaftaranBulanKemarin',
            'data' =>
            [
                'label' => 'Detaill Pendaftaran Bulan ',
                'namaBulan' => $date->subMonth()->isoFormat('MMMM'),
                'userLastMonth'=> DB::table('t_user')
                                ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                                ->whereYear('t_user.is_created',$year)
                                ->whereMonth('t_user.is_created',$lastMonth)
                                ->select('t_user.*','t_setting.*')->get(),
                // 'userLastMonth' => DB::select("SELECT u.nama_lengkap,u.is_created,u.produk_id, s.nama_toko, u.email,u.no_hp , u.alamat FROM t_user u, t_setting s WHERE u.id_user = s.id_user AND year(is_created) = year(now()) AND u.produk_id = '198' OR u.produk_id = '175' AND s.id_user = u.id_user GROUP BY u.id_user;"),

            ]
            ];
        return backend($request,$data);
    }
    public function detailTransaksiBulanLalu(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailBulanKemarinTotal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Bulan ',
                'namaBulan' => $date->subMonth()->isoFormat('MMMM'),

                'totalTransaksiLastMonth' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND year(is_created) = year(now()) AND month(is_created) = month(now()- INTERVAL 1 month) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND year(o.is_created) = year(now()) AND month(is_created) = month(now()- INTERVAL 1 month)) AS a;"),


            ]
            ];
        return backend($request,$data);
    }
    public function detailBulanLaluNominal(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailBulankemarinNominal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Sukses Bulan ',
                'namaBulan' => $date->subMonth()->isoFormat('MMMM'),
                'totalTransaksiLastMonthSukses' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND year(is_created) = year(now())  AND  month(is_created) = month(now()- INTERVAL 1 month) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND o.order_status = '4' AND year(o.is_created) = year(now())  AND  month(is_created) = month(now()- INTERVAL 1 month)) AS a;
                "),
            ]
            ];
        return backend($request,$data);
    }
    public function detailPendaftaranBulan(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailPendaftaranBulan',
            'data' =>
            [
                'label' => 'Detaill Pendaftaran Bulan ',
                'namaBulan' => Carbon::now()->isoFormat('MMMM'),
                'userMonth'=> DB::table('t_user')
                                ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                                ->whereYear('t_user.is_created',$year)
                                ->whereMonth('t_user.is_created',Carbon::now()->format('m'))
                                ->select('t_user.*','t_setting.*')->get(),
                // 'userLastMonth' => DB::select("SELECT u.nama_lengkap,u.is_created,u.produk_id, s.nama_toko, u.email,u.no_hp , u.alamat FROM t_user u, t_setting s WHERE u.id_user = s.id_user AND year(is_created) = year(now()) AND u.produk_id = '198' OR u.produk_id = '175' AND s.id_user = u.id_user GROUP BY u.id_user;"),

            ]
            ];
        return backend($request,$data);
    }
    public function detailTransaksiBulan(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $namaBulan = Carbon::now()->isoFormat('MMMM');
        $data = [
            'view' => 'detail.detailBulanTotal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Bulan ',
                'namaBulan' => $namaBulan,
                'totalTransaksiMonth' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND year(is_created) = year(now()) AND month(is_created) = month(now()) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND year(o.is_created) = year(now()) AND month(is_created) = month(now())) AS a;"),


            ]
            ];
        return backend($request,$data);
    }
    public function detailBulanNominal(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailBulanNominal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Sukses Bulan ',
                'namaBulan' => Carbon::now()->isoFormat('MMMM'),
                'totalTransaksiMonthSukses' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND year(is_created) = year(now())  AND  month(is_created) = month(now()) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND o.order_status = '4' AND year(o.is_created) = year(now())  AND  month(is_created) = month(now())) AS a;"),
            ]
            ];
        return backend($request,$data);
    }
    public function detailPendaftaranKemarin(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');

        $data = [
            'view' => 'detail.detailPendaftaranKemarin',
            'data' =>
            [
                'label' => 'Detaill Pendaftaran  ',
                'namaHari' => Carbon::yesterday()->isoFormat('dddd'),
                'userKemarin'=> DB::table('t_user')
                                ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                                ->whereYear('t_user.is_created',$year)
                                ->whereDate('t_user.is_created',$yesterday)
                                ->select('t_user.*','t_setting.*')->get(),
                // 'userLastMonth' => DB::select("SELECT u.nama_lengkap,u.is_created,u.produk_id, s.nama_toko, u.email,u.no_hp , u.alamat FROM t_user u, t_setting s WHERE u.id_user = s.id_user AND year(is_created) = year(now()) AND u.produk_id = '198' OR u.produk_id = '175' AND s.id_user = u.id_user GROUP BY u.id_user;"),

            ]
            ];
        return backend($request,$data);
    }
    public function detailTransaksiKemarin(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $namaBulan = Carbon::now()->isoFormat('MMMM');
        $data = [
            'view' => 'detail.detailKemarinTotal',
            'data' =>
            [
                'label' => 'Detaill Transaksi  ',
                'namaHari' => Carbon::yesterday()->isoFormat('dddd'),
                'totalTransaksiKemarin' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND date(is_created) = date(now()- INTERVAL 1 day) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND date(is_created) = date(now()- INTERVAL 1 day)) AS a;"),


            ]
            ];
        return backend($request,$data);
    }
    public function detailKemarinNominal(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailKemarinNominal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Sukses  ',
                'namaHari' => Carbon::yesterday()->isoFormat('dddd'),
                'totalTransaksiKemarinSukses' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND date(is_created) = date(now()- INTERVAL 1 day) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND o.order_status = '4' AND date(is_created) = date(now()- INTERVAL 1 day)) AS a;"),
            ]
            ];
        return backend($request,$data);
    }
    public function detailPendaftaranHariIni(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');

        $data = [
            'view' => 'detail.detailPendaftaranHariIni',
            'data' =>
            [
                'label' => 'Detaill Pendaftaran  ',
                'namaHari' => Carbon::now()->isoFormat('dddd'),
                'userKemarin'=> DB::table('t_user')
                                ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                                ->whereYear('t_user.is_created',$year)
                                ->whereDate('t_user.is_created',$now)
                                ->select('t_user.*','t_setting.*')->get(),

            ]
            ];
        return backend($request,$data);
    }
    public function detailTransaksiHariIni(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $namaBulan = Carbon::now()->isoFormat('MMMM');
        $data = [
            'view' => 'detail.detailHariIniTotal',
            'data' =>
            [
                'label' => 'Detaill Transaksi  ',
                'namaHari' => Carbon::now()->isoFormat('dddd'),
                'totalTransaksiHariIni' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND date(is_created) = date(now()) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND date(is_created) = date(now())) AS a;"),


            ]
            ];
        return backend($request,$data);
    }
    public function detailHariIniNominal(Request $request)
    {

        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth()->format('m');
        $data = [
            'view' => 'detail.detailHariIniNominal',
            'data' =>
            [
                'label' => 'Detaill Transaksi Sukses  ',
                'namaHari' => Carbon::yesterday()->isoFormat('dddd'),
                'totalTransaksiHariIniSukses' => DB::select("SELECT a.nama_toko,a.nama_produk, a.qty, a.totalbayar, a.is_created FROM (SELECT s.nama_toko ,k.nama_produk, k.qty, mo.totalbayar, mo.is_created FROM t_multi_order mo JOIN t_setting s JOIN t_keranjang k WHERE s.id_user = mo.id_user AND k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND date(is_created) = date(now()) GROUP BY k.kode_keranjang UNION ALL SELECT s.nama_toko, o.nama_produk, o.qty, o.totalbayar, o.is_created FROM `t_order` o JOIN t_setting s WHERE s.id_user = o.id_user AND o.order_status = '4' AND date(is_created) = date(now())) AS a;"),
            ]
            ];
        return backend($request,$data);
    }
    public function getDataTarget()
    {
        $target = Target::all();
        return json_decode($target);
    }
    public function getDataTransaksi(Request $request)
    {
        $dataTransaksi = DB::select("SELECT SUM(total) as total, id_user FROM (SELECT COUNT(*) AS total, id_user FROM t_multi_order WHERE id_user = $request->id_user UNION ALL SELECT COUNT(*) as total ,id_user FROM t_order WHERE id_user = $request->id_user) AS a;");
        echo json_encode($dataTransaksi);
    }
    public function simpanDataHistoryTarget(Request $request)
    {
        $now = \Carbon\Carbon::now()->format('y-m-d');
        $jam = \Carbon\Carbon::now()->format('h-s');
        $totalTransaksiHariSukses = DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order');
        $NominalTransaksiHariSukses = DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar');
        $totalTransaksiHari = DB::table('t_order')->whereDate('tgl_order',$now)->count('id_order')+ DB::table('t_multi_order')->whereDate('tgl_order',$now)->count('id_order');
        if (carbon::now()->format('H:i') == '10:14') {
            echo "Ada";
            // $post = HistoryTarget::create([
            //     'pendaftaran' => $totalTransaksiHariSukses,
            //     'transaksi' => $totalTransaksiHari,
            //     'nominal' => $NominalTransaksiHariSukses,

            // ]);
        }else {
            echo "tidak ada";
        }


        // if ($post) {
        //     return redirect()
        //         ->route('target.index')
        //         ->with([
        //             'success' => 'Target Berhasil Dibuat'
        //         ]);
        // } else {
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with([
        //             'error' => 'Target Tidak Berhasil Dibuat'
        //         ]);
        // }
    }
    public function getDataTransaksiSukses(Request $request)
    {
        $transaksi= DB::select("SELECT sum(total) AS total FROM (SELECT COUNT(*) AS total FROM t_order WHERE order_status = '4' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') UNION all SELECT COUNT(*) AS total FROM t_multi_order WHERE order_status = '4' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end')) AS a");
        echo json_encode($transaksi);
    }
    public function getDataPendaftaran(Request $request)
    {
        $pendaftaran = DB::select("SELECT COUNT(*) AS total FROM t_user WHERE date(is_created) BETWEEN date('$request->start') AND date('$request->end')");
        echo json_encode($pendaftaran);
    }
    public function getDataNominalTransaksi(Request $request)
    {
        $nominalTransaksi = DB::select("SELECT sum(total) AS total FROM (SELECT sum(totalbayar) AS total FROM t_order WHERE order_status = '4' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') UNION all SELECT sum(totalbayar) AS total FROM t_multi_order WHERE order_status = '4' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end')) AS a");
        echo json_encode($nominalTransaksi);

    }
}
