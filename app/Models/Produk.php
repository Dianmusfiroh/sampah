<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_produk',
        'id_user',
        'nama_produk',
        'jenis_produk',
        'harga_jual',
        'berat',
        'gambar',
        'deskripsi',
        'is_active',
        'status',
        'created'


    ];
    protected $table ='t_produk';
    public $timestamps = false;
}
