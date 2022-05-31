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
        // $prov =  Http::get('https://pro.rajaongkir.com/api/province');
        // $dataProv = $prov->json();
        // dd($dataProv);
        $chrtMember = '';
        $chrtJenis = '';
        foreach ($jenis as $item) {
            $chrtJenis .= $item->jumlah.',';


        }
        foreach ($member as $item) {
            $chrtMember .= $item->jumlah.',';
        }
        // print_r($chrtMember);
        // die;

        $data = [
            'view' => 'statistik.v_statistikMember',
            'data' =>
            [
                'label' => 'Statistik Member',
                'chrtMember' => $chrtMember ,
                'chrtJenis' => $chrtJenis

            ]
        ];
        return backend($request,$data);
    }
}
