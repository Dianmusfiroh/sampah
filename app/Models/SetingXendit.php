<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetingXendit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_setting_xendit';
    protected $fillable = [
        'id_setting_xendit',
        'id_user',
        'id',
        'created',
        'updated',
        'email',
        'type',
        'business_name',
        'country',
        'status',
        'is_active',
        'is_blocked',
        'pin',
        'status_qris',
        'status_va'

    ];
    protected $table ='t_setting_xendit';
    public $timestamps = false;
}
