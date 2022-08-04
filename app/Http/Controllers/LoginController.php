<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Models;
use Illuminate\Http\Request;


class LoginController extends Controller
{

    public function index(Request $request){
        // $user = User::get();
        // foreach ($user as $u)
        // dump ($u->name);
        // die;
        if(($request->session()->has('id'))):
            $rdc = redirect('beranda');
        else:
            $data['title'] = 'form login wbslink';
            $rdc = view('v_login',$data);
        endif;
        return $rdc;
    }
    public function log(Request $request){

        $this->model = new Models;
        $input = $request->user;
        $user = User::all();
        // foreach ($user as $u)
        $data = $this->model->log($request->user,$request->pass);
        // if(($request->user == $u->name ) && ($request->pass == $u->password )):
        if(!empty($data)):
            $file = [
                'id' =>1,
                'username' => $request->user,
            ];
            $request->session()->put($file);
            $rdc = redirect('beranda');
            print_r($input);
        else:
            $rdc = redirect('login');
        endif;
            return $rdc;
    }
    public function logout(Request $request) {
		$request->session()->forget('id');
		$request->session()->forget('username');
        return redirect('login');
	}
}
