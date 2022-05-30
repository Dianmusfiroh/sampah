<?php

namespace App\Exports;

use App\Models\tUser;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class UsersExpireExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $now = Carbon::now()->format('y-m-d');
        $data = DB::table('t_user')
        ->join('t_setting','t_setting.id_user','=','t_user.id_user')
        ->where('t_user.tgl_expired','>=',$now,)
        // ->select(where t_user.id_user = 31")
        ->whereIn('t_user.produk_id',['198','175'])
        ->get();

        // $hasil = DB::select("select no_hp from t_user  where no_hp='0808132000777876' and tgl_expired >= $now ");
        // dump($hasil);
        // foreach ($hasil as $item) {
        //     // if ($item->no_hp == '0808132000777876' ) {
        //     //     echo
        //     // }
        //   if (preg_match("/08/", substr("$item->no_hp",0,2))){

        //         echo (substr_replace("$item->no_hp","62",0,1));
        //     }


        // }
        // die();

        return view('report.v_reportUserTidakAktif', [
            'userExp' => DB::table('t_user')
            ->join('t_setting','t_setting.id_user','=','t_user.id_user')
            ->where('t_user.tgl_expired','<=',$now,)
            ->whereIn('t_user.produk_id',['198','175'])
            ->get()
        ]);
    }
}
