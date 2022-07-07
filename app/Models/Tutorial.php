<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tutorial';
    protected $fillable = [
        'id_tutorial',
        'menu',
        'link'
    ];
    protected $table ='t_tutorial';
    public $timestamps = false;
}
