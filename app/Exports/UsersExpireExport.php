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
        ->whereIn('t_user.produk_id',['198','175'])
        ->get();
        return view('report.v_reportUserTidakAktif', [
            'userExp' => DB::table('t_user')
            ->join('t_setting','t_setting.id_user','=','t_user.id_user')
            ->where('t_user.tgl_expired','<=',$now,)
            ->whereIn('t_user.produk_id',['198','175'])
            ->get()
        ]);
    }
}
