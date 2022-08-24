<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogNotifikasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_log_notif';
    protected $fillable = [
        'id_log_notif',
        'title',
        'description',
        'type'
    ];
    protected $table ='t_log_notif';
    public $timestamps = false;
}
