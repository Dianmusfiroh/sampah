<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kategori_bisnis';
    protected $fillable = [
        'id_kategori_bisnis',
        'kategori_bisnis'
    ];
    protected $table ='t_kategori_bisnis';
    public $timestamps = false;
}
