<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index(Request $request){
        $data = [
            'view' => 'v_statistik',
            'data' =>
            [
                'label' => 'Statistik'
            ]
        ];
        return backend($request,$data);
    }
}
