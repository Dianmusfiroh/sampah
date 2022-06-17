<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class UserFilterExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(request $request): View
    {
        $tanggal_awal = date('Y-m-t',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-t',strtotime($request->tanggal_akhir));
        // $tanggal_akhir = date('Y-m-t',strtotime('2022-06-14'));
        $userExp = DB::table('t_user')
                    ->join('t_setting','t_setting.id_user','=','t_user.id_user')
                    ->whereBetween('t_user.tgl_expired',[$tanggal_awal,$tanggal_akhir])
                    ->whereIn('t_user.produk_id',['198','175'])
                    ->get()
                    ;
        return view('report.v_reportUserTidakAktif', [
            'user' => DB::table('t_user')
            ->join('t_setting','t_setting.id_user','=','t_user.id_user')
            ->whereBetween('t_user.tgl_expired',[$tanggal_awal,$tanggal_akhir])
            ->whereIn('t_user.produk_id',['198','175'])
            ->get()

        ]);
    }
}
