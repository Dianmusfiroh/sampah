<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoguserController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'logAkun';
    }
    public function index(Request $request){
        $now = Carbon::now()->format('y-m-d');
        $log = DB::table('t_log')
                ->select('t_setting.*','t_log.*','t_user.*')
                ->join('t_setting','t_log.id_user','=','t_setting.id_user')
                ->join('t_user', 't_user.id_user','=','t_log.id_user')
                ->orderBy('t_log.id_log','DESC')
                ->get();
        foreach($log as $item){

        $logPensanan = json_decode($item->pesanan,true);
        $nama_toko = $item->nama_toko;

    }

        $log2 = DB::table('t_setting')
                ->select('t_setting.*')
                ->where('id_user')->get();
        $user = DB::table('t_user')->get();

        $modul = $this->modul;
        $data = [
            'view' => 'v_logUser',
            'data' =>
            [
                'label' => 'Log Activity User',
                'modul' => 'logUser',
                'now' =>$now,
                'logPensanan'=> $logPensanan,
                'log'=> $log,

            ]
        ];
        return backend($request,$data,$modul);
    }
}
