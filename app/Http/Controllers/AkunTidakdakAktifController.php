<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class AkunTidakdakAktifController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'akun';
    }
    public function index(Request $request)
    {
        $modul = $this->modul;
        $data = [
            'view' => 'user.v_akun',
            'data' =>
            [
                'label' => 'Akun',
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
