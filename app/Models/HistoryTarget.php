<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTarget extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_history_target';
    protected $fillable = [
        'id_history_target',
        'pendaftaran',
        'transaksi',
        'nominal',
        'waktu',


    ];
    protected $table ='t_history_target';
    public $timestamps = false;
}
