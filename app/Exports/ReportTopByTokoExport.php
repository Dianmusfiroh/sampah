<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ReportTopByTokoExport implements FromView
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function forYear($tanggal_awal,  $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        return $this;
    }
    public function view(): View
    {

        return view('report.p_reportTopByToko', [
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
            'userExp' =>
            DB::select("SELECT a.id_user ,s.nama_toko, s.email_toko,s.alamat_toko,s.permalink, s.no_hp_toko ,s.logo_toko,COUNT(a.total) AS total FROM(SELECT k.id_user, mo.tgl_selesai, k.id_produk AS total FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' AND date(mo.tgl_order) BETWEEN date(' $this->tanggal_awal') AND date('  $this->tanggal_akhir') UNION ALL SELECT o.id_user, o.tgl_order, o.id_user AS total FROM t_order o WHERE o.order_status='4' and date(o.tgl_order) BETWEEN date(' $this->tanggal_awal') AND date(' $this->tanggal_akhir')) AS a , t_setting s WHERE a.id_user = s.id_user GROUP BY a.id_user ORDER BY total DESC ;")

        ]);
    }
}
