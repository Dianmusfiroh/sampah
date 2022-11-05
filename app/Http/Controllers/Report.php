<?php

namespace App\Http\Controllers;

use App\Exports\DetailReportSellByProdukExport;
use App\Exports\DetailReportSellByTokoEXport;
use App\Exports\ReportTopByProdukExport;
use App\Exports\ReportTopByTokoExport;
use App\Exports\UserFilterExport;
use App\Exports\UsersExpireExport;
use App\Exports\UsersExport;
use App\Models\Order;
use App\Models\tUser;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Response;

class Report extends Controller
{
    protected $modul;
    protected $date;
    function __construct()
    {
        $this->modul = 'akun';
        $this->date = 'date';
    }
    public function index(Request $request){
        $now = Carbon::now();
        $mu = DB::select("SELECT COUNT(id_user) as qty , id_user FROM t_keranjang  GROUP BY id_user ");
        // dd($now->lastOfMonth()->format('m/d/Y'));
        $akunA = DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user'));
        foreach($akunA as $item){
            $order = DB::table('t_order')->where('id_user',$item->id_user)->count('order_id');
        }
        $penjualanToko = DB::select ("SELECT a.id_user ,s.nama_toko ,s.logo_toko,COUNT(a.total) AS total FROM(SELECT k.id_user, mo.tgl_selesai, k.id_produk AS total FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' AND month(mo.tgl_order) = month(now()) AND year(mo.tgl_order) = year(now()) UNION ALL SELECT o.id_user, o.tgl_order, o.id_user AS total FROM t_order o WHERE o.order_status='4' and month(o.tgl_order) = month(now()) AND year(o.tgl_order) = year(now())) AS a , t_setting s WHERE a.id_user = s.id_user GROUP BY a.id_user ORDER BY total DESC LIMIT 5");
        $produktotal = DB::select(DB::raw("SELECT t.id_user,s.nama_toko, t.id_produk,p.nama_produk,p.gambar ,sum(total) as total from ( SELECT a.id_user, a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND month(tgl_order)=month(now()) AND year(tgl_order)= year(now())) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total FROM `t_order` o WHERE o.order_status='4' AND month(o.tgl_order)= month(now()) AND year(o.tgl_order) =year(now()) GROUP BY id_produk) AS t JOIN t_produk p JOIN t_setting s WHERE s.id_user = t.id_user AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5"));

        if ($request->tanggal_awal != '' && $request->tanggal_akhir != '') {
            $penjualanToko = DB::select("SELECT a.id_user ,s.nama_toko ,s.logo_toko,COUNT(a.total) AS total ,a.tgl_order FROM(SELECT k.id_user, mo.tgl_order, k.id_produk AS total FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' UNION ALL SELECT o.id_user, o.tgl_order, o.id_user AS total FROM t_order o WHERE o.order_status='4' ) AS a , t_setting s WHERE a.id_user = s.id_user AND a.tgl_order BETWEEN '$request->tanggal_awal' AND '$request->tanggal_akhir' GROUP BY a.id_user ORDER BY total DESC LIMIT 5");
            $produktotal = DB::select("SELECT t.id_user,s.nama_toko, t.id_produk,p.nama_produk,p.gambar ,sum(total) as total , t.tgl_order from ( SELECT a.id_user, a.id_produk , COUNT(a.id_produk) as total , a.tgl_order FROM (SELECT k.id_user, k.id_produk, mo.tgl_order FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' ) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total , tgl_order FROM `t_order` o WHERE o.order_status='4'  GROUP BY id_produk) AS t JOIN t_produk p JOIN t_setting s WHERE s.id_user = t.id_user AND p.id_produk = t.id_produk AND t.tgl_order BETWEEN '$request->tanggal_awal' AND '$request->tanggal_akhir' GROUP BY t.id_produk ORDER BY total DESC limit 5");
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
        $mu = DB::select("SELECT COUNT(id_user) as qty , id_user FROM t_keranjang  GROUP BY id_user ");

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
    public function cetakTidakAktif_pdf(Request $request)
    {


        $expired = new UsersExpireExport();
        return Excel::download($expired,'Laporan User Tidak Aktif.xlsx');

    }
    public function reportAkun(request $request)
    {
        $tanggal_awal = date('Y-m-t',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-t',strtotime($request->tanggal_akhir));
        $modul = $this->modul;
        $data = [
            'view' => 'report.v_reportAkun',
            'data' =>
            [
                'label' => 'Report Member',
                'modul' => 'report',
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),
                'user'  => DB::table('t_user')
                ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                ->whereBetween('t_user.tgl_expired',[$tanggal_awal,$tanggal_akhir])
                ->whereIn('t_user.produk_id',['198','175'])
                ->get(),
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function userFilter(request $request)
    {
        $tanggal_awal = date($request->start);
        $tanggal_akhir = date($request->end);
        $act =(new UserFilterExport)->forYear($tanggal_awal,$tanggal_akhir)->download('Daftar Akun expire '.$tanggal_awal.'-'.$tanggal_akhir.'.xlsx');
        return $act;
    }
    public function storeAkun(request $request)
    {

        $tanggal_awal = date($request->tanggal_awal);
        $tanggal_akhir = date($request->tanggal_akhir);
        $act =(new ReportTopByTokoExport)->forYear($tanggal_awal,$tanggal_akhir)->download('Daftar Akun '.$tanggal_awal.'-'.$tanggal_akhir.'.xlsx');
        return $act;
    }
    public function topProdukExport(request $request)
    {

        $tanggal_awal = date($request->tanggal_awal);
        $tanggal_akhir = date($request->tanggal_akhir);
        $act =(new ReportTopByProdukExport)->forYear($tanggal_awal,$tanggal_akhir)->download('Daftar Akun '.$tanggal_awal.'-'.$tanggal_akhir.'.xlsx');
        return $act;
    }
    public function detailTopTokoExport(request $request)
    {
        $tanggal_awal = date($request->tanggal_awal);
        $id_user = $request->id_user;
        $tanggal_akhir = date($request->tanggal_akhir);
        $act =(new DetailReportSellByTokoEXport)->forYear($tanggal_awal,$tanggal_akhir,$id_user)->download('Daftar Akun '.$tanggal_awal.'-'.$tanggal_akhir.'.xlsx');
        return $act;
    }
    public function detailTopProdukExport(request $request)
    {
        $tanggal_awal = date($request->tanggal_awal);
        $id_user = $request->id_user;
        $id_produk = $request->id_produk;
        $tanggal_akhir = date($request->tanggal_akhir);
        $act =(new DetailReportSellByProdukExport)->forYear($tanggal_awal,$tanggal_akhir,$id_user,$id_produk)->download('Daftar Akun '.$tanggal_awal.'-'.$tanggal_akhir.'.xlsx');
        return $act;
    }
    // public function search(Request $request)
    // {

    //     if($request->ajax())
    //     {
    //      if($request->tanggal_awal != '' && $request->tanggal_akhir != '')
    //      {
    //         $penjualanToko = DB::select("SELECT a.id_user ,s.nama_toko ,s.logo_toko,COUNT(a.total) AS total ,a.tgl_order FROM(SELECT k.id_user, mo.tgl_order, k.id_produk AS total FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' UNION ALL SELECT o.id_user, o.tgl_order, o.id_user AS total FROM t_order o WHERE o.order_status='4' ) AS a , t_setting s WHERE a.id_user = s.id_user AND a.tgl_order BETWEEN '$request->tanggal_awal' AND '$request->tanggal_akhir' GROUP BY a.id_user ORDER BY total DESC LIMIT 5");
    //         $produk = DB::select("SELECT t.id_user,s.nama_toko, t.id_produk,p.nama_produk,p.gambar ,sum(total) as total , t.tgl_order from ( SELECT a.id_user, a.id_produk , COUNT(a.id_produk) as total , a.tgl_order FROM (SELECT k.id_user, k.id_produk, mo.tgl_order FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' ) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total , tgl_order FROM `t_order` o WHERE o.order_status='4'  GROUP BY id_produk) AS t JOIN t_produk p JOIN t_setting s WHERE s.id_user = t.id_user AND p.id_produk = t.id_produk AND t.tgl_order BETWEEN '$request->tanggal_awal' AND '$request->tanggal_akhir' GROUP BY t.id_produk ORDER BY total DESC limit 5");
    //      }
    //      return response()->json([
    //        'penjualanToko' => $penjualanToko,
    //        'produk' => $produk
    //     ]);
    //     }
    // }
    //Script Jadi
    public function search(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        if($tanggal_awal != '' && $tanggal_akhir != ''){
            $penjualanToko = DB::select("SELECT a.id_user ,s.nama_toko ,s.logo_toko,COUNT(a.total) AS total ,a.tgl_order FROM(SELECT k.id_user, mo.tgl_order, k.id_produk AS total FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' UNION ALL SELECT o.id_user, o.tgl_order, o.id_user AS total FROM t_order o WHERE o.order_status='4' ) AS a , t_setting s WHERE a.id_user = s.id_user AND a.tgl_order BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY a.id_user ORDER BY total DESC LIMIT 5");
            $produk = DB::select("SELECT t.id_user,s.nama_toko, t.id_produk,p.nama_produk,p.gambar ,sum(total) as total , t.tgl_order from ( SELECT a.id_user, a.id_produk , COUNT(a.id_produk) as total , a.tgl_order FROM (SELECT k.id_user, k.id_produk, mo.tgl_order FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' ) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total , tgl_order FROM `t_order` o WHERE o.order_status='4'  GROUP BY id_produk) AS t JOIN t_produk p JOIN t_setting s WHERE s.id_user = t.id_user AND p.id_produk = t.id_produk AND t.tgl_order BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY t.id_produk ORDER BY total DESC limit 5");
        }
        return response()->json([
            'penjualanToko' => $penjualanToko,
            'produk' => $produk,
        ]);
    }
    public function get_data(Request $request)
    {
        $dataStart = $request->start;
        $penjualanToko = DB::select ("SELECT a.id_user ,s.nama_toko ,s.logo_toko,COUNT(a.total) AS total FROM(SELECT k.id_user, mo.tgl_selesai, k.id_produk AS total FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' AND date(mo.tgl_order) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT o.id_user, o.tgl_order, o.id_user AS total FROM t_order o WHERE o.order_status='4' and date(o.tgl_order) BETWEEN date('$request->start') AND date('$request->end')) AS a , t_setting s WHERE a.id_user = s.id_user GROUP BY a.id_user ORDER BY total DESC LIMIT 10");
        echo json_encode($penjualanToko);
    }
    public function get_dataTotal(Request $request)
    {
        $produktotal = DB::select(DB::raw("SELECT t.id_user,s.nama_toko, t.id_produk,p.nama_produk,p.gambar ,sum(total) as total from ( SELECT a.id_user, a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND date(mo.tgl_order) BETWEEN date('$request->start') AND date('$request->end')) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total FROM `t_order` o WHERE o.order_status='4' AND date(o.tgl_order) BETWEEN date('$request->start') AND date('$request->end') GROUP BY id_produk) AS t JOIN t_produk p JOIN t_setting s WHERE s.id_user = t.id_user AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 10"));
        echo json_encode($produktotal);
    }
    public function detailSellByToko( Request $request)
    {

        $modul = $this->modul;
        $data = [
            'view' => 'report.v_detailReportSellByToko',
            'data' =>
            [
                'label' => 'Detail Penjualan  ',
                'modul' => 'report',
                'tanggal_awal' => $request->start,
                'tanggal_akhir' => $request->end,
                'id_user' => $request->id_user,
                'namaToko' => DB::table('t_setting')->where('id_user',$request->id_user)->select('nama_toko')->first(),
                'detail' => DB::select("SELECT a.id_user ,u.nama_lengkap,s.nama_toko,a.tgl_order,a.tgl_kirim, a.tgl_selesai ,a.nama_pembeli,a.nama_produk,a.jenis_produk,s.logo_toko FROM(SELECT k.id_user,mo.tgl_order,mo.tgl_kirim, mo.tgl_selesai,mo.nama_pembeli, k.nama_produk, k.jenis_produk FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' AND date(mo.tgl_order) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT o.id_user, o.tgl_order,o.tgl_kirim,o.tgl_selesai,o.nama_pembeli,o.nama_produk, o.jenis_produk AS total FROM t_order o WHERE o.order_status='4' and date(o.tgl_order) BETWEEN date('$request->start') AND date('$request->end')) AS a , t_setting s, t_user u WHERE a.id_user = u.id_user AND a.id_user = s.id_user AND a.id_user = $request->id_user;"),

            ]
        ];
        return backend($request,$data,$modul);

    }
    public function detailSellByProduk( Request $request)
    {
        $modul = $this->modul;
        $data = [
            'view' => 'report.v_detailReportSellByProduk',
            'data' =>
            [
                'label' => 'Detail Penjualan  ',
                'modul' => 'report',
                'tanggal_awal' => $request->start,
                'tanggal_akhir' => $request->end,
                'id_user' => $request->id_user,
                'id_produk'=>$request->id_produk,
                'namaProduk' => DB::table('t_produk')->where('id_produk',$request->id_produk)->select('nama_produk')->first(),
                'detail' => DB::select("SELECT t.id_user,u.nama_lengkap,p.jenis_produk,s.nama_toko,t.nama_pembeli, t.tgl_order, t.tgl_kirim, t.tgl_selesai, t.id_produk,p.nama_produk,p.gambar from ( SELECT a.id_user, a.id_produk , a.nama_pembeli, a.tgl_order,a.tgl_kirim, a.tgl_selesai FROM (SELECT k.id_user, k.id_produk,mo.nama_pembeli,mo.tgl_order,mo.tgl_kirim,mo.tgl_selesai FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND date(mo.tgl_order) BETWEEN date('$request->start') AND date('$request->end')) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk, o.nama_pembeli,tgl_order,tgl_kirim,tgl_selesai FROM `t_order` o WHERE o.order_status='4' AND date(o.tgl_order) BETWEEN date('$request->start') AND date('$request->end')) AS t JOIN t_produk p JOIN t_setting s , t_user u WHERE t.id_user = u.id_user AND s.id_user = t.id_user AND p.id_produk = t.id_produk AND t.id_produk = $request->id_produk;"),

            ]
        ];
        return backend($request,$data,$modul);

    }
    public function destroy(Request $request)
    {
        # code...
    }
}
