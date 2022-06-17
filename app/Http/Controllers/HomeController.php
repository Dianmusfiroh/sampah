<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tUser;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
                'totalTransaksiHariSukses' => DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->count('id_order'),
                'NominalTransaksiHariSukses' => DB::table('t_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar')+ DB::table('t_multi_order')->where('order_status','4')->whereDate('tgl_order',$now)->sum('totalbayar'),
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
                'chart'=> $chrtExp
                ]
            ];
        return backend($request,$data);
    }
}
