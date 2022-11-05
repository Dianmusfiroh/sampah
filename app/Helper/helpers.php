<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function rupiah($angka){

	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	echo $hasil_rupiah;

}
function backend($request,$data){
	if(($request->session()->has('id'))):
		return view('v_template',$data);
	else:
		return redirect('login');
	endif;
}
function gabunganOrder($request){
    // $single = DB::table('t_order')->select('id_user','id_order')->groupBy('id_user')->orderBy('id_user','DESC')->limit(5)->get();
    // $multi = DB::table('t_multi_order')->select('id_user','id_order')->groupBy('id_user')->orderBy('id_user','DESC')->limit(5)->get();
    $single = DB::select("SELECT COUNT(id_user) as qty FROM t_order  GROUP BY id_user");
    $multi = DB::select("SELECT COUNT(id_user) as qty FROM t_order  GROUP BY id_user");
    $total = $single[0]->qty+ $multi[0]->qty;
    dd($request) ;
    // foreach ($total as $item) {
    //   echo $item;

    // }
}
function linkToko()
{
    # code...
}
// function islogtrue(Request $request){
// 	if(($request->session()->has('id'))):
// 		return redirect('template');
// 	endif;
// }
// function islogfalse(Request $request){
// 	if(empty($request->session()->has('id'))):
// 		return redirect('login');
// 	endif;
// }
function get_local_time(){

    $ip = file_get_contents("http://ipecho.net/plain");

    $url = 'http://ip-api.com/json/'.$ip;

    $tz = file_get_contents($url);

    $tz = json_decode($tz,true)['timezone'];

    return $tz;

 }
