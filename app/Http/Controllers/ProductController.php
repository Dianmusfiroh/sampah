<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $data = [
            'view' => 'v_product',
            'data' => 
            [
                'label' => 'product'
            ]
        ];
        return backend($request,$data);
    }
}
