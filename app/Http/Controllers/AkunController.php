<?php

namespace App\Http\Controllers;
use App\Models\tUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $akunA = DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user'));

        foreach($akunA as $item){
            $order = DB::table('t_order')->where('id_user',$item->id_user)->count('order_id');
         }
        //  dd($order);

        $modul = $this->modul;
        $data = [
            'view' => 'user.v_akun',
            'data' =>
            [
                'label' => 'Akun',
                'modul' => 'akun',
                'now' =>$now,
                'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id IN (175,198) AND s.id_user= u.id_user')),
                // 'akunA'=>  DB::select(DB::raw('select u.*,s.*, current_date() as tgl_sekarang,datediff(u.tgl_expired, current_date()) as selisih from t_user u, t_setting s WHERE u.produk_id = 175 && 198 AND s.id_user= u.id_user')),
                'addBulan' =>$addBulan,
            ]
        ];
        return backend($request,$data,$modul);
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
        // // dd($);
        // die();
        $now = Carbon::now()->format('Y-m-d') ;
        $year = Carbon::now();

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
        // // ->join('t_multi_order','t_user.id_user','=','t_multi_order.id_user')
            ->select('t_user.*','t_setting.nama_toko')
            ->where('t_user.id_user','=',$id_user)
            // ->whereIn('tgl_expired','>',$now)
            ->get();
            // echo $akun[0]->user_id;die;
            // foreach ($akun as $item){
                $json = file_get_contents('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$akun[0]->user_id.'&product_id='.$akun[0]->produk_id.'');
            // }


        // dd($produk);
    //
    //     ->get();
    //     foreach($akun AS $item){
    //         if (Str::slug($item->nama_toko) == true) {
    //            echo "ada";
    //         } else {
    //             echo "no";
    //         }

    //     }
    //     die();
        // @if ({{Str::slug($item->nama_toko)}} == true)
        // ada
        // @else ({{Str::slug($item->nama_toko)}} == false)
        //     tidak
        // @endif
        // }
        $modul = $this->modul;
        $data = [
            'view' => 'user.v_akundetail',
            'data' =>
            [
                'label' => 'Akun',
                'modul' => 'akun',
                'exp' => $json,
                'transaksi' =>$total,
                'totalbayar' =>$totalbayar,
                'now' => Carbon::now()->format('Y-m-d'),
                'addWeek' => $year->addWeek()->format('y-m-d'),
                'produk' => DB::table('t_produk')
                            ->join('t_produk_link','t_produk.id_produk','=','t_produk_link.id_produk')
                            ->where('t_produk.id_user',$id_user)->get(),
                // 'akun' =>  DB::select('select u.*,s.*, current_date() as tgl_sekarang from t_user u ,t_setting s WHERE u.id_user = s.id_user  AND u.user_id = "$id_user" AND u.produk_id IN (175,198) and u.tgl_expired >= CURRENT_DATE()')

                'akun' =>   DB::table('t_user')
                            ->Join('t_setting','t_user.id_user','=','t_setting.id_user')
                        // // ->join('t_multi_order','t_user.id_user','=','t_multi_order.id_user')
                            ->select('t_user.*','t_setting.nama_toko')
                            ->where('t_user.id_user','=',$id_user)
                            // ->whereIn('tgl_expired','>',$now)

                            ->get()
            ]
        ];
        return backend($request,$data,$modul);
        // $user= tUser::find($id_user);
        // // dd($user);
        // if (request()->wantsJson()) {

        //     return response()->json([
        //         'data' => $user,
        //     ]);
        // }

        // return view('v_akundetail', compact('user'));

        // $id_user;
        // DB::SELECT('DELETE e.*,u.*,b.*,pv.*, pu.*, pl.*, p.*, o.*, kl.*, k.*, s.* FROM `t_expedisi` e, t_user u, t_bank b, t_produk_varian pv, t_produk_ukuran pu, t_produk_link pl, t_produk p, t_order o, t_kurir_lokal kl, t_kupon k, t_setting s WHERE u.id_user= "$id_user"');
        // // DELETE e.*,u.*,b.*,pv.*, pu.*, pl.*, p.*, o.*, kl.*, k.*, s.* FROM `t_expedisi` e, t_user u, t_bank b, t_produk_varian pv, t_produk_ukuran pu, t_produk_link pl, t_produk p, t_order o, t_kurir_lokal kl, t_kupon k, t_setting s WHERE u.id_user=40
    }
    public function updateStatus(Request $request)
    {
        $user = tUser::find($request->id_user);
        $user->id_user = $request->id_user;
        $user->is_active = $request->is_active;
        $user->save();
    }
    public function destroy($id_user){
        // $id_user;
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

        // // // $hps = DB::table('t_user')
        // ->join('t_expedisi','t_user.id_user','=','t_expedisi.id_user')
        // ->join('t_bank','t_user.id_user','=','t_bank.id_user')
        // ->join('t_produk_varian','t_user.id_user','=','t_produk_varian.id_user')
        // ->join('t_produk_ukuran','t_user.id_user','=','t_produk_ukuran.id_user')
        // ->join('t_produk_link','t_user.id_user','=','t_produk_link.id_user')
        // ->join('t_produk','t_user.id_user','=','t_produk.id_user')
        // ->join('t_order','t_user.id_user','=','t_order.id_user')
        // ->join('t_kupon','t_user.id_user','=','t_kupon.id_user')
        // ->join('t_setting','t_user.id_user','=','t_setting.id_user')
        // ->join('t_kurir_lokal','t_user.id_user','=','t_kurir_lokal.id_user')
        // $detail = DB::select(DB::raw("DELETE e.*,u.*,b.*,pv.*, pu.*, pl.*, p.*, o.*, kl.*, k.*, s.* FROM `t_expedisi` e, t_user u, t_bank b, t_produk_varian pv, t_produk_ukuran pu, t_produk_link pl, t_produk p, t_order o, t_kurir_lokal kl,t_kupon k, t_setting s WHERE u.id_user=$id_user"));

        // $hapus = DB::SELECT('DELETE e.*,u.*,b.*,pv.*, pu.*, pl.*, p.*, o.*, kl.*, k.*, s.* FROM `t_expedisi` e, t_user u, t_bank b, t_produk_varian pv, t_produk_ukuran pu, t_produk_link pl, t_produk p, t_order o, t_kurir_lokal kl, t_kupon k, t_setting s WHERE u.id_user=$id_user');
        return redirect('akun/');

        // DELETE e.*,u.*,b.*,pv.*, pu.*, pl.*, p.*, o.*, kl.*, k.*, s.* FROM `t_expedisi` e, t_user u, t_bank b, t_produk_varian pv, t_produk_ukuran pu, t_produk_link pl, t_produk p, t_order o, t_kurir_lokal kl, t_kupon k, t_setting s WHERE u.id_user=40
    }
}
