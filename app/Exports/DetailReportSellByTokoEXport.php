<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DetailReportSellByTokoEXport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function forYear( $tanggal_awal,  $tanggal_akhir , $id_user)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->id_user   = $id_user;
        return $this;
    }
    public function view(): View
    {

        return view('report.p_detailReportByToko', [
            'tanggal_awal'=>$this->tanggal_awal,
            'tanggal_akhir'=>$this->tanggal_akhir,
            'nama_toko' =>DB::table('t_setting')->select('nama_toko')->where('id_user','=',$this->id_user)->first(),
            'detail' => DB::select("SELECT a.id_user ,u.nama_lengkap,s.nama_toko,a.tgl_order,a.tgl_kirim, a.tgl_selesai ,a.nama_pembeli,a.nama_produk,a.jenis_produk,s.logo_toko FROM(SELECT k.id_user,mo.tgl_order,mo.tgl_kirim, mo.tgl_selesai,mo.nama_pembeli, k.nama_produk, k.jenis_produk FROM `t_keranjang` k , t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status ='4' AND date(mo.tgl_order) BETWEEN date('$this->tanggal_awal') AND date('$this->tanggal_akhir') UNION ALL SELECT o.id_user, o.tgl_order,o.tgl_kirim,o.tgl_selesai,o.nama_pembeli,o.nama_produk, o.jenis_produk AS total FROM t_order o WHERE o.order_status='4' and date(o.tgl_order) BETWEEN date('$this->tanggal_awal') AND date('$this->tanggal_akhir')) AS a , t_setting s, t_user u WHERE a.id_user = u.id_user AND a.id_user = s.id_user AND a.id_user =  $this->id_user;"),


        ]);
    }
}
