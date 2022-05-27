<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\tUser;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Report extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'akun';
    }
    public function index(Request $request){
        $now = Carbon::now();
        $addBulan = $now->addMonth();
        // $o = Order::select('id_user')->get();
        // $order = DB::table('t_order')
        //         ->select('id_user as qty ')
        //         ->groupBy('id_user')
        //         ->orderBy('id_user')
        //         ->get();
        // $keranjang = DB::table('t_keranjang')
        //         ->select('id_user as qty ')
        //         ->groupBy('id_user')
        //         ->orderBy('id_user')
        //         ->get();
        $single = DB::select(DB::raw("SELECT COUNT(id_user) as qty , id_user FROM t_order GROUP BY id_user "));
        $mu = DB::select("SELECT COUNT(id_user) as qty , id_user FROM t_keranjang  GROUP BY id_user ");

        // $order = DB::select(DB::raw("SELECT COUNT(id_user) as qty  FROM t_order where id_user = $idUser "));

        // dump($idUser );
        // if ( $single[0]->id_user = 32) {
        //     dump ($single[0]->qty + $mu[0]->qty);
        // }

        foreach ($single as $s ){
            $idUser= $s->id_user;
        $keranjang = DB::select(DB::raw("SELECT COUNT(id_user) as qty  FROM t_keranjang where id_user = '$idUser' GROUP BY id_user "));
        // $data =$keranjang[0]->qty;
        // dump($data);
        // $hasil = '';
        // if (isset($keranjang)){
        //         $hasil = $s->qty+$keranjang->qty;
        //         dump($hasil );
        //     }
        }

        // die;

        $akunA = DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user'));
        foreach($akunA as $item){
            $order = DB::table('t_order')->where('id_user',$item->id_user)->count('order_id');
         }

        //  dd($order);

        $modul = $this->modul;
        $data = [
            'view' => 'v_report',
            'data' =>
            [
                'label' => 'Report',
                'modul' => 'report',
                'now' =>$now,
                // 'totalOrder' =>gabunganOrder($id_user),
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),
                // 'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id = 175 && 198 AND s.id_user= u.id_user')),
                'addBulan' =>$addBulan,
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function cetakAktif_pdf()
    {
        $now = Carbon::now()->format('y-m-d');
        // $user= DB::table('t_user')->whereDate('is_created','>=',$now)->get();
        $user = DB::table('t_user')
                ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                ->where('t_user.tgl_expired','>=',$now,)
                ->whereIn('t_user.produk_id',['198','175'])
                ->get();
        // $user = DB::select(DB::raw("SELECT u.*, s.* FROM `t_user` u, t_setting s WHERE year(tgl_expired) >= year(now()) AND month(tgl_expired) >= month(now()) AND day(tgl_expired) >= day(now()) AND u.id_user = s.id_user"));
        $nama = '';
        // dd($user);
        $pdf   = PDF::loadview('v_reportUserAktif', compact('user'))->setPaper('a4', 'landscape');
        return $pdf->download('LaporanUserAktif.PDF');
    }
    public function cetakTidakAktif_pdf()
    {
        $now = Carbon::now()->format('y-m-d');
        // $user= DB::table('t_user')->whereDate('is_created','>=',$now)->get();
        $user = DB::table('t_user')
                ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                ->where('t_user.tgl_expired','<=',$now,)
                ->whereIn('t_user.produk_id',['198','175'])
                ->get();
        // $user = DB::select(DB::raw("SELECT u.*, s.* FROM `t_user` u, t_setting s WHERE year(tgl_expired) >= year(now()) AND month(tgl_expired) >= month(now()) AND day(tgl_expired) >= day(now()) AND u.id_user = s.id_user"));
        $nama = '';
        // dd($user);
        $pdf   = PDF::loadview('v_reportUserTidakAktif', compact('user'))->setPaper('a4', 'landscape');
        return $pdf->download('Laporan User Tidak Aktif.PDF');
    }
}
