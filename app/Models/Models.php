<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Models extends Model
{
    use HasFactory;
    function order(){
        $order = DB::select("SELECT p.nama_produk as produk,o.gambar_produk, o.id_produk, COUNT(o.id_produk) as jumlah FROM t_order o join t_produk p WHERE o.id_produk = p.id_produk AND YEAR(o.tgl_order) = YEAR(NOW()) AND MONTH(o.tgl_order)=MONTH(NOW()) GROUP BY p.id_produk ORDER BY COUNT(o.id_produk) DESC LIMIT 3");
        return $order;
    }
    function chartOrder(){
        $chart = DB::select("SELECT COUNT(id_order ) AS jumlah, tgl_order FROM `t_order` WHERE YEAR(tgl_order) = YEAR(NOW()) GROUP BY month(tgl_order) ORDER BY month(tgl_order)");
        return $chart;

    }

    public function log($user,$pass){
        $data = DB::select("SELECT name,password FROM `users` WHERE name='$user' AND password='$pass'");
        return $data;
    }

    public function data(){
        return 'dian musyiforah';
        // $geom = DB::raw('');
        // return $geom;
        // $quert=DB::insert('');
        // $quert=DB::update('');
        // $quert=DB::select('');
        // $quert=DB::delete('');
    }
    public function oke(){
        return 'aku aku';
    }
}
