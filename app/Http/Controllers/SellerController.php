<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(Request $request){
        $data = [
            'view' => 'v_seller',
            'data' => 
            [
                'label' => 'seller'
            ]
        ];
        return backend($request,$data);
    }
}
