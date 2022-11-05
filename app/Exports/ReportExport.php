<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $now = Carbon::now()->format('y-m-d');

        return view('report.v_reportUserAktif', [
            'userAktif' => DB::table('t_user')
            ->join('t_setting','t_setting.id_user','=','t_user.id_user')
            ->where('t_user.tgl_expired','>=',$now,)
            ->whereIn('t_user.produk_id',['198','175'])
            ->get()
        ]);
    }
}
