<?php

namespace App\Http\Controllers;

use App\Exports\UsersExpireExport;
use App\Exports\UsersExport;
use App\Models\Order;
use App\Models\tUser;
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
        $now = Carbon::now()->format('y-m-d');

        // $addBulan = $now->addMonth();
        //query for data top produk
        // SELECT id_produk ,sum(total) as total from (
        //     SELECT a.id_produk ,a.nama_produk, COUNT(*) as total FROM (SELECT k.id_user, k.id_produk, p.nama_produk FROM `t_keranjang` k JOIN t_multi_order mo JOIN t_produk p WHERE k.kode_keranjang = mo.kode_keranjang AND k.id_produk = p.id_produk) AS a GROUP BY a.id_produk
        //     UNION ALL
        //     SELECT p.nama_produk,o.id_produk,COUNT(*) AS total FROM `t_order` o JOIN t_produk p WHERE p.id_produk = o.id_produk GROUP BY id_produk) AS t GROUP BY t.id_produk ORDER BY total DESC
            $penjualanToko = DB::select("SELECT a.id_user ,s.nama_toko ,s.logo_toko, a.tgl_selesai , a.total FROM(SELECT  k.id_user, mo.tgl_selesai,  COUNT(k.id_produk) AS total FROM `t_keranjang` k , t_multi_order mo WHERE  k.kode_keranjang = mo.kode_keranjang AND k.id_user = 241 AND mo.order_status ='4' AND month(mo.tgl_selesai) = month(now()) AND year(mo.tgl_selesai) = year(now()) UNION ALL SELECT o.id_user, o.tgl_selesai,  COUNT(o.id_user) AS total FROM t_order o WHERE month(o.tgl_selesai) = month(now()) AND year(o.tgl_selesai) = year(now())) AS a , t_setting s WHERE a.id_user = s.id_user GROUP BY a.id_user ORDER BY total DESC LIMIT 5");
            $produktotal = DB::select(DB::raw("SELECT t.id_produk,p.nama_produk,p.gambar ,sum(total) as total, pl.link from ( SELECT a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND month(tgl_selesai)=month(now()) AND year(tgl_selesai)= year(now())) AS a GROUP BY a.id_produk UNION ALL SELECT id_produk,COUNT(id_produk) AS total FROM `t_order` o WHERE month(o.tgl_selesai)= month(now()) AND year(o.tgl_selesai) =year(now()) GROUP BY id_produk) AS t JOIN t_produk p JOIN t_produk_link pl WHERE pl.id_produk = t.id_produk AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5"));
        $mu = DB::select("SELECT COUNT(id_user) as qty , id_user FROM t_keranjang  GROUP BY id_user ");




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
                'produk' => $produktotal,
                'penjualanToko' =>$penjualanToko,

                // 'totalOrder' =>gabunganOrder($id_user),
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function topProduk(Request $request){
        $now = Carbon::now();
        $addBulan = $now->addMonth();
        //count id_produk multi order
        // SELECT COUNT(k.id_produk) AS qty ,k.id_produk FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang GROUP BY id_produk ORDER BY qty DESC
        $mu = DB::select("SELECT COUNT(id_user) as qty , id_user FROM t_keranjang  GROUP BY id_user ");
        // foreach ($single as $s ){
        //     $idUser= $s->id_user;
        // $keranjang = DB::select(DB::raw("SELECT COUNT(id_user) as qty  FROM t_keranjang where id_user = '$idUser' GROUP BY id_user "));
        // }


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
                'total' => 'single',
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
    public function reportAkun(request $request)
    {
        $modul = $this->modul;
        $data = [
            'view' => 'report.v_reportAkun',
            'data' =>
            [
                'label' => 'Report',
                'modul' => 'report',
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),

            ]
        ];
        return backend($request,$data,$modul);
    }
}
