<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ReportTopByProdukExport implements FromView
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

        return view('report.p_reportTopByProduk', [
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
            'topProduk' =>
            DB::select("SELECT t.id_user,s.nama_toko, t.id_produk,p.nama_produk,p.gambar ,s.email_toko,s.alamat_toko,s.permalink,s.no_hp_toko,sum(total) as total from ( SELECT a.id_user, a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND date(mo.tgl_order) BETWEEN date('$this->tanggal_awal') AND date('$this->tanggal_akhir')) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk,COUNT(id_produk) AS total FROM `t_order` o WHERE o.order_status='4' AND date(o.tgl_order) BETWEEN date('$this->tanggal_awal') AND date('$this->tanggal_akhir') GROUP BY id_produk) AS t JOIN t_produk p JOIN t_setting s WHERE s.id_user = t.id_user AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC;")

        ]);
    }
}
