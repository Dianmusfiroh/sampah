<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StatistikController extends Controller
{
    public function index(Request $request){
        $Month = Carbon::now()->format('m');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');

    //week
        $weekTotal = DB::select('SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order, YEARWEEK(tgl_order) FROM `t_multi_order` WHERE YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE()) UNION ALL SELECT tgl_order as total, tgl_order, YEARWEEK(tgl_order) FROM `t_order` WHERE YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE())) AS a GROUP by day(a.tgl_order) ORDER BY a.tgl_order');
        $weekSelesai = DB::select('SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order, YEARWEEK(tgl_order) FROM `t_multi_order` WHERE order_status = "4" AND YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE()) UNION ALL SELECT tgl_order as total, tgl_order, YEARWEEK(tgl_order) FROM `t_order` WHERE order_status = "4" AND YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE())) AS a GROUP by day(a.tgl_order) ORDER by a.tgl_order');
        $weekTerkirim = DB::select('SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order, YEARWEEK(tgl_order) FROM `t_multi_order` WHERE order_status = "3" AND YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE()) UNION ALL SELECT tgl_order as total, tgl_order, YEARWEEK(tgl_order) FROM `t_order` WHERE order_status = "3" AND YEARWEEK(tgl_order) = YEARWEEK(NOW())  AND DAYOFWEEK(CURDATE())) AS a GROUP by day(a.tgl_order) ORDER BY a.tgl_order');
        $chrtWeekSelesai = '';
        $chrtWeekTerkirim = '';
        $chrtWeekTotal = '';
        $namaHariSelesai = '';
        $namaHariTotal = '';
        $namaHariTerkirim = '';
        foreach ($weekTotal as $item){
            $chrtWeekTotal .= $item->total.',';
            // $namaHariTotal .= '"'.$item->tgl_order.'"'.',';
            $namaHariTotal .= '"'.Carbon::parse($item->tgl_order)->isoFormat('dddd').'"'.',';
        }
        foreach ($weekSelesai as $item){
            $chrtWeekSelesai .= $item->total.',';
            // $namaHariSelesai .= '"'.$item->tgl_order.'"'.',';
            $namaHariSelesai .= '"'.Carbon::parse($item->tgl_order)->isoFormat('dddd').'"'.',';
        }
        foreach ($weekTerkirim as $item){
            $chrtWeekTerkirim .= $item->total.',';
            // $namaHariTerkirim .= '"'.$item->tgl_order.'"'.',';
            $namaHariTerkirim .= '"'.Carbon::parse($item->tgl_order)->isoFormat('dddd').'"'.',';
        }
        //month
        $bulanSelesai = DB::select('SELECT COUNT(a.total) AS total, a.bulan ,a.namabulan FROM (SELECT id_order AS total, monthname(tgl_order) AS namabulan,month(tgl_order) AS bulan FROM `t_multi_order` WHERE order_status="4" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) UNION SELECT id_order AS total, monthname(tgl_order) AS namabulan,month(tgl_order) AS bulan FROM `t_order` WHERE order_status="4" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) )AS a GROUP BY bulan');
        $bulanProses = DB::select('SELECT COUNT(a.total) AS total, a.bulan ,a.namabulan FROM (SELECT id_order AS total, month(tgl_order) AS bulan , monthname(tgl_order) AS namabulan FROM `t_multi_order` WHERE order_status="3" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) UNION SELECT id_order AS total, month(tgl_order) AS bulan, monthname(tgl_order) AS namabulan FROM `t_order` WHERE order_status="3" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) )AS a GROUP BY bulan');
        $bulanPemesanan = DB::select('SELECT COUNT(a.total) AS total, a.bulan ,a.namabulan FROM (SELECT id_order AS total, month(tgl_order) AS bulan, monthname(tgl_order) AS namabulan FROM `t_multi_order` WHERE   month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) UNION SELECT id_order AS total, month(tgl_order) AS bulan , monthname(tgl_order) AS namabulan FROM `t_order` WHERE month(tgl_order) = month(tgl_order)  AND year(tgl_order)= year(tgl_order) )AS a GROUP BY bulan');
        $namaBulan = '';
        $chrtSelesai = '';
        $chrtProses = '';
        $chrtPemesanan = '';
        $prosesBulan = '';
        $pemesananBulan = '';
        foreach ($bulanSelesai as $item) {
            $chrtSelesai .= $item->total.',';
            $namaBulan .= '"'.$item->namabulan.'"'.',';
            // $namaBulan .= '"'.Carbon::parse($item->bulan)->isoFormat('MMMM').'"'.',';


        }
        foreach ($bulanProses as $item) {
            $chrtProses .= $item->total.',';
            $prosesBulan .= '"'.$item->namabulan.'"'.',';
            // $prosesBulan .= '"'.Carbon::parse($item->bulan)->isoFormat('MMMM').'"'.',';

        }
        foreach ($bulanPemesanan as $item) {
            $chrtPemesanan .= $item->total.',';
            $pemesananBulan .= '"'.$item->namabulan.'"'.',';
            // $pemesananBulan .= '"'.Carbon::parse($item->bulan)->isoFormat('MMMM').'"'.',';

        }

        //year
        $tahunSelesai = DB::select('SELECT count(a.total) AS total, a.tahun AS tahun FROM (SELECT id_order AS total, year(tgl_order) AS tahun FROM `t_order` WHERE order_status="4" UNION ALL SELECT id_order AS total, year(tgl_order) FROM `t_multi_order` WHERE order_status="4" )AS a GROUP BY a.tahun');
        $tahunProses = DB::select('SELECT count(a.total) AS total, a.tahun AS tahun FROM (SELECT id_order AS total, year(tgl_order) AS tahun FROM `t_order` WHERE order_status="3" UNION ALL SELECT id_order AS total, year(tgl_order) FROM `t_multi_order` WHERE order_status="3" )AS a GROUP BY a.tahun');
        $tahunPemesanan = DB::select('SELECT count(a.total) AS total, a.tahun AS tahun FROM (SELECT id_order AS total, year(tgl_order) AS tahun FROM `t_order`  UNION ALL SELECT id_order AS total, year(tgl_order) FROM `t_multi_order`)AS a GROUP BY a.tahun');
        $namaTahunSelesai = '';
        $namaTahunProses = '';
        $namaTahunPemesanan = '';
        $chartTahunSelesai = '';
        $chartTahunProses = '';
        $chartTahunPemesanan = '';
        foreach ($tahunSelesai as $item) {
            $chartTahunSelesai .= $item->total.',';
            $namaTahunSelesai .= '"'.$item->tahun.'"'.',';
        }
        foreach ($tahunProses as $item) {
            $chartTahunProses .= $item->total.',';
            $namaTahunProses .= '"'.$item->tahun.'"'.',';
        }
        foreach ($tahunPemesanan as $item) {
            $chartTahunPemesanan .= $item->total.',';
            $namaTahunPemesanan .= '"'.$item->tahun.'"'.',';
        }
        $orderTR =  DB::table('t_order')
                ->whereMonth('tgl_order', $Month)
                ->where('order_status','4')
                ->groupBy('id_user')
                ->get();
        $multiOrderTR =  DB::table('t_multi_order')
                ->whereMonth('tgl_order', $Month)
                ->where('order_status','4')
                ->groupBy('tgl_order')
                ->get();
        // @dump($multiOrderTR);
        // die();
        $data = [
            'view' => 'statistik.v_statistik',
            'data' =>
            [
                'label' => 'Statistik',
                //bulan
                'chrtSelesai' => $chrtSelesai,
                'chrtProses' => $chrtProses,
                'chrtPemesanan' => $chrtPemesanan,
                'namaBulan' => $namaBulan,
                'prosesBulan' => $prosesBulan,
                'pemesananBulan' => $pemesananBulan,
                //tahun
                'chartTahunSelesai' => $chartTahunSelesai,
                'chartTahunProses' => $chartTahunProses,
                'chartTahunPemesanan' => $chartTahunPemesanan,
                'namaTahunSelesai' =>  $namaTahunSelesai ,
                'namaTahunProses' => $namaTahunProses,
                'namaTahunPemesanan' => $namaTahunPemesanan,
                //minggu
                'chrtWeekSelesai' => $chrtWeekSelesai,
                'chrtWeekTerkirim' => $chrtWeekTerkirim,
                'chrtWeekTotal' => $chrtWeekTotal,
                'namaHariTotal' => $namaHariTotal,
                'namaHariSelesai' => $namaHariSelesai,
                'namaHariTerkirim' => $namaHariTerkirim,
            ]
        ];
        return backend($request,$data);
    }

    public function statistikMember(Request $request)
    {
        $jenis = DB::select('SELECT  COUNT(id_kategori_bisnis) as jumlah,id_kategori_bisnis,prov FROM t_setting GROUP BY prov , id_kategori_bisnis');
        $member = DB::select('SELECT COUNT(id_user) as jumlah,prov FROM t_setting GROUP BY prov');
        // $prov = Http::withHeaders([
        //         'key' => '739f0fb277b8be3c8eb812b552467ea0'
        //         ])
        //         ->get('https://pro.rajaongkir.com/api/province');
        // // $prov = file_get_contents("./province.json");
        // // $hasil =  json_encode($prov);

        // $hasil = $prov['rajaongkir']['results'];


        // foreach($hasil as $item){
        //     echo $item->province;

        // }

    // $curl = curl_init();

    // curl_setopt_array($curl, array(
    // CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    // CURLOPT_RETURNTRANSFER => true,
    // CURLOPT_ENCODING => "",
    // CURLOPT_MAXREDIRS => 10,
    // CURLOPT_TIMEOUT => 30,
    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    // CURLOPT_CUSTOMREQUEST => "GET",
    // CURLOPT_HTTPHEADER => array(
    //     "key: 739f0fb277b8be3c8eb812b552467ea0"
    // ),
    // ));

    // $response = curl_exec($curl);
    // $err = curl_error($curl);

    // curl_close($curl);

    // if ($err) {
    // echo "cURL Error #:" . $err;
    // } else {
    //     $hasil = json_decode($response,true);
    //     $tes = ($hasil['rajaongkir']['results']['province']);
    //     echo $tes;

    // }
    //     die();

        $chrtMember = '';
        $prov = '';
        $province = '';
        $chrtJenis = '';

        foreach ($jenis as $item) {
            $chrtJenis .= $item->jumlah.',';

            // }

        }
        foreach ($member as $item) {
            $chrtMember .= $item->jumlah.',';
            $prov .=  $item->prov.',';
            if ($prov ='0'){
                $province .= 'tidak memilih';
            } else if($prov = '1'){
                $province .= 'Bali';
            }else if($prov = '2'){
                $province .= 'banka';
            }else {
            };

        };
        // dd($prov);


        $data = [
            'view' => 'statistik.v_statistikMember',
            'data' =>
            [
                'label' => 'Statistik Member',
                'chrtMember' => $chrtMember ,
                'chrtJenis' => $chrtJenis,
                'prov' => $prov,

            ]
        ];
        return backend($request,$data);
    }
    public function statistikJenisUsaha(request $request)
    {
        $dataJU    = DB::table('t_setting')
        ->join('t_kategori_bisnis','t_setting.id_kategori_bisnis','=','t_kategori_bisnis.id_kategori_bisnis')
        ->select('t_setting.id_kategori_bisnis', 't_kategori_bisnis.kategori_bisnis')
        ->addSelect(DB::raw('COUNT("t_setting.id_user") as total'))
        ->groupBy(DB::raw('t_setting.id_kategori_bisnis'))
        ->get();


        $namaKU = '';
        $chrtTotal = '';

        foreach ($dataJU as $item) {
            $chrtTotal .= '"'.$item->total.'"'.',';
            $namaKU .= '"'.$item->kategori_bisnis.'"'.',';
        }
        $data = [
            'view' => 'statistik.v_statistikJenisUsaha',
            'data' =>
            [
                'label'     => 'Statistik Jenis Usaha',
                'namaKU'     =>$namaKU,
                'chrtTotal' => $chrtTotal,

            ]
        ];
        return backend($request,$data);
    }
}
