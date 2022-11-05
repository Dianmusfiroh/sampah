<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_target';
    protected $fillable = [
        'id_target',
        'pendaftaran',
        'transaksi',
        'nominal',
        'bulan',
        'tahun',


    ];
    protected $table ='t_target';
    public $timestamps = false;
}
