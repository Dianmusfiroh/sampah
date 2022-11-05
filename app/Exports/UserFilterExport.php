<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UserFilterExport implements FromView
// class UserFilterExport implements FromQuery
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function forYear( $tanggal_awal,  $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        return $this;
    }
    public function view(): View
    {

        return view('report.v_reportUserFilter', [
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
            'user' => DB::table('t_user')
            ->join('t_setting','t_setting.id_user','=','t_user.id_user')
            ->whereBetween('t_user.tgl_expired',[$this->tanggal_awal,$this->tanggal_akhir])
            ->whereIn('t_user.produk_id',['175','198'])
            ->get()
        ]);
    }
}
