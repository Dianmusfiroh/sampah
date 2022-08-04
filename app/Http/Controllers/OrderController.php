<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $data = [
            'view' => 'v_order',
            'data' => 
            [
                'label' => 'order'
            ]
        ];
        return backend($request,$data);
    }
}
