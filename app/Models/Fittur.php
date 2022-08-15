<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fittur extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_fittur';
    protected $fillable = [
        'id_fittur',
        'fittur',
        'harga',


    ];
    protected $table ='t_fittur';
    public $timestamps = false;
}
