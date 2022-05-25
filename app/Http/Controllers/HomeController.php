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
        $year = Carbon::now();
        $now = Carbon::now()->format('y-m-d');

        $addWeek = $year->addWeek()->format('y-m-d');

        $day = Carbon::now()->format('d');
        $Month = Carbon::now()->format('m');
        // $order = DB::select(DB::raw('SELECT COUNT(id_order) AS jumlah, tgl_order FROM t_order WHERE year(tgl_order)= year(NOW()) GROUP BY month(tgl_order)'));
        $user = DB::select(DB::raw('SELECT COUNT(id_user) AS jumlah, is_created FROM t_user WHERE year(is_created)= year(NOW())  GROUP BY month(is_created)'));
        $userExp = DB::select(DB::raw('SELECT COUNT(id_user) AS jumlah, tgl_expired FROM t_user WHERE year(tgl_expired)= year(NOW())  GROUP BY month(tgl_expired)'));
        $jumlah=0;
        $orderTR =  DB::table('t_order')
                ->whereMonth('tgl_order', $Month)
                ->where('order_status','4')
                ->sum('totalbayar');
        $multiOrderTR =  DB::table('t_multi_order')
                ->whereMonth('tgl_order', $Month)
                ->where('order_status','4')
                ->sum('totalbayar');

        $chrtExp = '';
        $orderUser = '';
        foreach ($userExp as $item) {
            $chrtExp .= $item->jumlah.',';
        }
        foreach ($user as $item) {
            $orderUser .= $item->jumlah.',';
        }

        $data = [
            'view' => 'v_home',
            'data' =>
            [
                'label' => 'Dashboard',
                'user'=>  tUser::whereIn('produk_id',['198','175']),
                'userToDay'=> DB::table('t_user')->whereDate('is_created',$now)->count('id_user'),
                'userExpToDay'=> DB::table('t_user')->whereDate('tgl_expired',$now)->count('id_user'),
                'totalTransaksiRP' => $orderTR + $multiOrderTR,
                'totalTransaksi' => DB::table('t_order')->count('id_order')+ DB::table('t_multi_order')->count('id_order'),
                'totalTransaksiSelesai' => DB::table('t_order')->where('order_status','4')->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->count('id_order'),
                'userA'=>  DB::select(DB::raw('select
                count(id_user) as total,produk_id, tgl_expired, current_date() as tgl_sekarang,datediff(tgl_expired, current_date()) as selisih from t_user WHERE produk_id IN (175,198) and tgl_expired >= CURRENT_DATE()')),
                'akunA'=>  DB::table('t_user')
                            ->join('t_setting','t_user.id_user','=','t_setting.id_user')
                            ->select('t_user.*','t_setting.*')
                            ->whereBetween('t_user.tgl_expired', ["$now", "$addWeek"])->get(),
                'produk'=> Produk::all(),
                'chartUser' => $orderUser ,
                'bestSeller'=> DB::select(DB::raw('SELECT COUNT(id_produk) AS jumlah, id_user,id_produk, nama_produk AS produk, tgl_order
                FROM   t_order WHERE year(tgl_order) = year(NOW()) AND month(tgl_order) = month(NOW())
                GROUP  BY id_produk ORDER BY COUNT(id_produk) DESC LIMIT 5')),
                'chart'=> $chrtExp
                ]
            ];
        return backend($request,$data);
    }
}
