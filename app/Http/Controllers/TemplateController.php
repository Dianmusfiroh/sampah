<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(Request $request){
        $data['view'] = 'v_home';
        return backend($request,$data);
    }
}
