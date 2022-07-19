<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendNotifikasiController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'sendNotification';
    }
    public function index(Request $request){
        $modul = $this->modul;
        $data = [
            'view' => 'v_sendNotification',
            'data' =>
            [
                'label' => 'Kirim Notifikasi',
                'modul' => 'sendNotification',

            ]
        ];
        return backend($request,$data,$modul);
    }
}
