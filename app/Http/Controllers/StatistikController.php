<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = [
            'view' => 'statistik.v_statistikMember',
            'data' =>
            [
                'label' => 'Statistik Member'
            ]
        ];
        return backend($request,$data);
    }
}
