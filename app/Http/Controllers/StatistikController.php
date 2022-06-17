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
        // $Month = Carbon::now()->format('m');

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
                'label' => 'Statistik'
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
}
