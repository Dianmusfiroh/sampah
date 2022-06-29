<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_user',
        'username',
        'password',
        'nama_lengkap',
        'email',
        'no_hp',
        'alamat',
        'user_id',
        'produk_id',
        'tgl_expired',
        'is_active',
        'is_created'

    ];
    protected $table ='t_user';
    public $timestamps = false;
}
