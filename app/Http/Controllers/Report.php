<?php

namespace App\Http\Controllers;

use App\Exports\UsersExpireExport;
use App\Exports\UsersExport;
use App\Models\Order;
use App\Models\tUser;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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


        $akunA = DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user'));
        foreach($akunA as $item){
            $order = DB::table('t_order')->where('id_user',$item->id_user)->count('order_id');
         }


        $modul = $this->modul;
        $data = [
            'view' => 'report.v_report',
            'data' =>
            [
                'label' => 'Report',
                'modul' => 'report',
                'now' =>$now,
                // 'totalOrder' =>gabunganOrder($id_user),
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),
                'addBulan' =>$addBulan,
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function topProduk(Request $request){
        $now = Carbon::now();
        $addBulan = $now->addMonth();
        //count id_produk multi order
        // SELECT COUNT(k.id_produk) AS qty ,k.id_produk FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang GROUP BY id_produk ORDER BY qty DESC
        $single = DB::select(DB::raw("SELECT COUNT(id_user) as qty , id_user FROM t_order GROUP BY id_user "));
        $mu = DB::select("SELECT COUNT(id_user) as qty , id_user FROM t_keranjang  GROUP BY id_user ");
        foreach ($single as $s ){
            $idUser= $s->id_user;
        $keranjang = DB::select(DB::raw("SELECT COUNT(id_user) as qty  FROM t_keranjang where id_user = '$idUser' GROUP BY id_user "));
        }


        $akunA = DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user'));
        foreach($akunA as $item){
            $order = DB::table('t_order')->where('id_user',$item->id_user)->count('order_id');
         }


        $modul = $this->modul;
        $data = [
            'view' => 'report.v_reportProduk',
            'data' =>
            [
                'label' => 'Produk Terbaik',
                'modul' => 'report',
                'now' =>$now,
                // 'totalOrder' =>gabunganOrder($id_user),
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),
                'addBulan' =>$addBulan,
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function cetakAktif_pdf()
    {
        $export = new UsersExport();
        return Excel::download($export,'Laporan User Aktif.xlsx');
    }
    public function cetakTidakAktif_pdf()
    {

        $now = Carbon::now()->format('y-m-d');

        // $userExp = DB::table('t_user')
        // ->join('t_setting','t_setting.id_user','=','t_user.id_user')
        // ->where('t_user.tgl_expired','<=',$now,)
        // // ->select(where t_user.id_user = 31")
        // ->whereIn('t_user.produk_id',['198','175'])
        // ->get();
        $expired = new UsersExpireExport();


        // $pdf   = PDF::loadview('v_reportUserTidakAktif', compact('userExp'))->setPaper('a4', 'landscape');
        // return $pdf->download('Laporan User Tidak Aktif.PDF');
        return Excel::download($expired,'Laporan User Tidak Aktif.xlsx');

    }
}
