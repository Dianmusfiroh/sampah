<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCustom extends Model
{
    use HasFactory;
    protected $primaryKey = 'kd_fittur';
    protected $fillable = [
        'kd_fittur',
        'id_fittur',
        'id_user',
        'status'


    ];
    protected $table ='t_set_fittur';
    public $timestamps = false;
}
