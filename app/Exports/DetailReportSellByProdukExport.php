<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class DetailReportSellByProdukExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function forYear( $tanggal_awal,  $tanggal_akhir , $id_user , $id_produk)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->id_user   = $id_user;
        $this->id_produk   = $id_produk;
        return $this;
    }
    public function view(): View
    {

        return view('report.p_detailReportByProduk', [
            'tanggal_awal'=>$this->tanggal_awal,
            'tanggal_akhir'=>$this->tanggal_akhir,
            'nama_toko' =>DB::table('t_setting')->select('nama_toko')->where('id_user','=',$this->id_user)->first(),
            'nama_produk' =>DB::table('t_produk')->select('nama_produk')->where('id_produk','=',$this->id_produk)->first(),
            'detail' => DB::select("SELECT t.id_user,u.nama_lengkap,p.jenis_produk,s.nama_toko,t.nama_pembeli, t.tgl_order, t.tgl_kirim, t.tgl_selesai, t.id_produk,p.nama_produk,p.gambar from ( SELECT a.id_user, a.id_produk , a.nama_pembeli, a.tgl_order,a.tgl_kirim, a.tgl_selesai FROM (SELECT k.id_user, k.id_produk,mo.nama_pembeli,mo.tgl_order,mo.tgl_kirim,mo.tgl_selesai FROM `t_keranjang` k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND mo.order_status = '4' AND date(mo.tgl_order) BETWEEN date('$this->tanggal_awal') AND date('$this->tanggal_akhir')) AS a GROUP BY a.id_produk UNION ALL SELECT id_user,id_produk, o.nama_pembeli,tgl_order,tgl_kirim,tgl_selesai FROM `t_order` o WHERE o.order_status='4' AND date(o.tgl_order) BETWEEN date('$this->tanggal_awal') AND date('$this->tanggal_akhir')) AS t JOIN t_produk p JOIN t_setting s , t_user u WHERE t.id_user = u.id_user AND s.id_user = t.id_user AND p.id_produk = t.id_produk AND t.id_produk = $this->id_produk;"),


        ]);
    }
}
