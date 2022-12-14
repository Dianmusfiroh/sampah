<?php

namespace App\Http\Controllers;
use App\Models\tUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\Order;
use App\Models\SetingXendit;
use App\Models\SettingXendit;
use App\Models\Tutorial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\SettingCustom;
use App\Models\Fittur;
use Illuminate\Support\Facades\Http;

class AkunController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'akun';
    }
    public function index(Request $request){
        $now = Carbon::now();

        $addBulan = $now->addMonth();
        $akunA = DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user '));
        $akun =   DB::table('t_user')
            ->Join('t_setting','t_user.id_user','=','t_setting.id_user')
            ->select('t_user.*','t_setting.*')
            ->limit(10)
            ->get();
        foreach($akunA as $item){
            $order = DB::table('t_order')->where('id_user',$item->id_user)->count('order_id');
         }
        $modul = $this->modul;
        $data = [
            'view' => 'user.v_akun',
            'data' =>
            [
                'label' => 'Akun',
                'modul' => 'akun',
                'now' =>$now,
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),
                'addBulan' =>$addBulan,
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function data()
    {
        $akunA = DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user '));

        $akun =   DB::table('t_user')
        ->Join('t_setting','t_user.id_user','=','t_setting.id_user')
        ->select('t_user.*','t_setting.*')
        ->limit(10)
        ->get();

        return DataTables::of($akunA)
        ->addIndexColumn()
        ->addColumn('action', function($row){

               $btn = '';
               if (preg_match("/_/",$row->nama_toko)){
               $btn .= '<a href="https://wbslink.id/'.$row->nama_toko .'" target="_blank" title="'.$row->nama_lengkap.'" alamat="'.$row->alamat.'" ><i class="material-icons md-open_in_browser"></i></a>';

               }else{
               $btn .= '<a href="https://wbslink.id/'.Str::slug($row->nama_toko).'" target="_blank" title="'.$row->nama_lengkap.'" alamat="'.$row->alamat.'" ><i class="material-icons md-open_in_browser"></i></a>';
                }
               $btn .='<a href="javascript:;" data-toggle="modal" onclick="deleteData('.$row->id_user.')"
                   data-target="#DeleteModal" class="material-icons md-delete_outline">
               </a>';
                return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function userAktif(Request $request){


        $modul = $this->modul;
        $data = [
            'view' => 'user.v_akunAktif',
            'data' =>
            [
                'label' => 'Akun Aktif',
                'modul' => 'akun',
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang from t_user u ,t_setting s WHERE u.id_user = s.id_user AND u.produk_id IN (175,198) and u.tgl_expired >= CURRENT_DATE()')),
                // 'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id = 175 && 198 AND s.id_user= u.id_user')),
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function show(Request $request, $id_user ){
        $now = Carbon::now()->format('Y-m-d') ;
        $year = Carbon::now();

        //pendapatan perbulan
        $pendapatanbulan = DB::select("SELECT t.kodebulan,t.bulan , SUM(t.total) AS total FROM (SELECT a.kodebulan,a.bulan , a.total AS total FROM (SELECT month(tgl_selesai) as kodebulan, monthname(tgl_selesai) AS bulan, totalbayar AS total FROM `t_order` WHERE year(tgl_selesai) = year(now()) AND id_user = $id_user AND order_status = '4' ) AS a UNION ALL SELECT month(tgl_selesai) as kodebulan, monthname(tgl_selesai) AS bulan ,totalbayar AS total FROM `t_multi_order` WHERE  year(tgl_selesai) = year(now())  AND id_user = $id_user AND order_status = '4' ) AS t GROUP by bulan ORDER by kodebulan ASC");
        $bulan = '';
        $totalpendapatan = '';
        foreach ($pendapatanbulan as $item){
            $bulan .= "'".$item->bulan."'".",";
            $totalpendapatan .= $item->total.',';
        }
        //END pendapatan perbulan
        //top produk Perbulan
        $produkTOP = DB::select("SELECT t.id_user, t.id_produk,p.nama_produk ,sum(total) as total from ( SELECT a.id_user,a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND k.id_user = $id_user AND mo.order_status='4' AND month(mo.tgl_selesai)=month(now()) AND year(mo.tgl_selesai)=year(now()) )AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total FROM `t_order` WHERE id_user = $id_user AND order_status ='4' AND month(tgl_selesai)=month(now()) AND year(tgl_selesai)=year(now()) GROUP BY id_produk) AS t JOIN t_produk p WHERE p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5");
        $produk = '';
        $totalproduk = '';
        foreach ($produkTOP as $item){
            $produk .= "'".$item->nama_produk."'".",";
            $totalproduk .= $item->total.',';
        }
        // SELECT t.id_user, t.id_produk,p.nama_produk ,sum(total) as total from ( SELECT a.id_user,a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND k.id_user = 32 AND mo.order_status='4' ) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total FROM `t_order` WHERE id_user = 32 AND order_status ='4' GROUP BY id_produk) AS t JOIN t_produk p WHERE p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5
        //end top produk perbulan
        $order = DB::table('t_order')
            ->select('order_id')
            ->where('id_user','=',$id_user)
            ->get();
        $multiOrder = DB::table('t_multi_order')
        ->select('totalbayar')
        ->where ('id_user','=',$id_user)->get();
        $total =count($order)+count($multiOrder);
        $tborder = DB::table('t_order')
        ->where('id_user','=',$id_user)
        ->sum('totalbayar');
        $tbmultiOrder = DB::table('t_multi_order')
        ->where ('id_user','=',$id_user)
        ->sum('totalbayar');
        $totalbayar =$tborder+$tbmultiOrder;
        $akun =   DB::table('t_user')
            ->Join('t_setting','t_user.id_user','=','t_setting.id_user')
            ->select('t_user.*','t_setting.nama_toko')
            ->where('t_user.id_user','=',$id_user)
            ->get();

                $json = file_get_contents('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$akun[0]->user_id.'&product_id='.$akun[0]->produk_id.'');

                $modul = $this->modul;
        $data = [
            'view' => 'user.v_akundetail',
            'data' =>
            [
                'label' => 'Akun',
                'modul' => 'akun',
                'exp' => $json,
                'xendit'=> SetingXendit::where('id_user',$id_user)->first(),
                'transaksi' =>$total,
                'totalbayar' =>$totalbayar,
                'now' => Carbon::now()->format('Y-m-d'),
                'addWeek' => $year->addWeek()->format('y-m-d'),
                'produk' => DB::table('t_produk')
                            ->join('t_setting','t_produk.id_user','=','t_setting.id_user')
                            ->where('t_produk.id_user',$id_user)->get(),
                'totalpendapatan' => $totalpendapatan,
                'bulan' => $bulan,
                'produkNama' => $produk,
                'produkTotal' => $totalproduk,
                'akun' =>   DB::table('t_user')
                            ->Join('t_setting','t_user.id_user','=','t_setting.id_user')
                            ->select('t_user.*','t_setting.*')
                            ->where('t_user.id_user','=',$id_user)
                            ->get(),
                'settingCustom' => SettingCustom::join('t_fittur','t_fittur.id_fittur','=','t_set_fittur.id_fittur')
                                ->where('id_user',$id_user)->get(),
                'fittur' => Fittur::all(),
            ]
        ];
        return backend($request,$data,$modul);
    }

    public function destroy($id_user){
        $user = DB::table('t_user')->where ('id_user','=',$id_user)->delete();
        $expedisi = DB::table('t_expedisi')->where ('id_user','=',$id_user)->delete();
        $bank = DB::table('t_bank')->where ('id_user','=',$id_user)->delete();
        $produkVarian = DB::table('t_produk_varian')->where ('id_user','=',$id_user)->delete();
        $ProdukUkuran = DB::table('t_produk_ukuran')->where ('id_user','=',$id_user)->delete();
        $produkLink = DB::table('t_produk_link')->where ('id_user','=',$id_user)->delete();
        $produk = DB::table('t_produk')->where ('id_user','=',$id_user)->delete();
        $order = DB::table('t_order')->where ('id_user','=',$id_user)->delete();
        $kupon = DB::table('t_kupon')->where ('id_user','=',$id_user)->delete();
        $setting = DB::table('t_setting')->where ('id_user','=',$id_user)->delete();
        $kurir_lokal = DB::table('t_kurir_lokal')->where ('id_user','=',$id_user)->delete();

        return back()->withInput();
        // return redirect('akun/');

    }
    public function V_akunTidakAktif(Request $request)
    {


        $modul = $this->modul;
        $data = [
            'view' => 'user.v_akunTidakAktif',
            'data' =>
            [
                'label' => 'Akun Tidak Aktif Lebih Dari 3 Bulan',
                'modul' => 'akun',
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function akunTidakAktif()
    {
        $akunA = DB::select(' SELECT s.nama_toko ,u.user_id,u.email,u.no_hp,u.nama_lengkap,u.produk_id, u.id_user, u.username, u.tgl_expired FROM `t_user` u, t_setting s WHERE s.id_user = u.id_user AND u.produk_id BETWEEN 175 AND 198 AND u.tgl_expired < now()- INTERVAL 90 day');
        // DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user  '));
        // foreach ($akunA as $item) {
        //     $dt      = Carbon::now();
        //     $setExp = $dt->subDay(90)->format('Y-m-d');
        //     $response = Http::withHeaders([])
        //     ->get('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$item->user_id.'&product_id='.$item->produk_id);
        //     $user_id = $item->user_id;
        //     $produk_id = $item->produk_id;
        //     if ($response < $setExp) {
        //         $tes = DB::select(DB::raw("select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user AND user_id = $user_id AND produk_id = $produk_id LIMIT 20 "));
        //     }
        // }
        return DataTables::of($akunA)
        ->addIndexColumn()
        ->addColumn('getExp', function($row){
            $response = Http::withHeaders([])
            ->get('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$row->user_id.'&product_id='.$row->produk_id);
                return $response->body( );
        })
        ->rawColumns(['getExp'])
            ->addColumn('action', function($row){

                $btn = '';

                $btn .='<a href="javascript:;" data-toggle="modal" onclick="deleteData('.$row->id_user.')"
                    data-target="#DeleteModal" class="material-icons md-delete_outline">
                </a>';
                return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
