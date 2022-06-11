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
        $addWeek = $year->addWeek()->format('y-m-d');

        $now = Carbon::now()->format('y-m-d');
        $akun=  DB::table('t_user')
                            ->join('t_setting','t_user.id_user','=','t_setting.id_user')
                            ->select('t_user.*','t_setting.*')->get();
        // $json = file_get_contents('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$akun[0]->user_id.'&product_id='.$akun[0]->produk_id.'');

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
            $chrtExp .= $item->jumlah.',';
        }
        foreach ($user as $item) {
            $orderUser .= $item->jumlah.',';
        }
        $akun =   DB::table('t_user')
        ->Join('t_setting','t_user.id_user','=','t_setting.id_user')
        ->select('t_user.*','t_setting.nama_toko')
        ->get();
            // $json = file_get_contents('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$item[0]->user_id.'&product_id='.$item[0]->produk_id.'');
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
                // 'exp' => $json,
                'bestSeller'=> DB::select(DB::raw('SELECT p.id_user,t.id_produk ,p.nama_produk,p.gambar ,sum(total) as jumlah, pl.link from ( SELECT a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM t_keranjang k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND month(tgl_selesai)=month(now()) AND year(tgl_selesai)= year(now())) AS a GROUP BY a.id_produk UNION ALL SELECT id_produk,COUNT(id_produk) AS total FROM t_order o WHERE month(o.tgl_selesai)= month(now()) AND year(o.tgl_selesai) =year(now()) GROUP BY id_produk) AS t JOIN t_produk p JOIN t_produk_link pl WHERE pl.id_produk = t.id_produk AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5')),
                'chart'=> $chrtExp
                ]
            ];
        return backend($request,$data);
    }
}
