<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingCustom;
use App\Models\Fittur;
use Illuminate\Support\Facades\DB;



class settingCustomController extends Controller
{
    protected $modul;
    protected $date;
    function __construct()
    {
        $this->modul = 'settingCustom';
        $this->date = 'date';
    }
    // public function index(Request $request){
    //     $modul = $this->modul;
    //     $data = [
    //         'view' => 'fittur.index',
    //         'data' =>
    //         [
    //             'label' => 'Fittur',
    //             'modul' => 'fittur',
    //             'Fittur' => Fittur::all(),
    //         ]
    //     ];
    //     return backend($request,$data,$modul);
    // }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_fittur' => 'required',
            'id_user'=>'required',
        ]);
        $post = SettingCustom::create([
            'id_fittur' => $request->id_fittur,
            'id_user' => $request->id_user,
            'status' => '0',
        ]);

        if ($post) {
            return redirect()
                ->route('akun.show',$request->id_user)
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function updateStatusCustom(Request $request)
    {

        $SettingCustom = SettingCustom::where('kd_fittur',$request->kd_fittur)->first();
        $SettingCustom->kd_fittur = $request->kd_fittur;
        $SettingCustom->status = $request->status;

        $SettingCustom->save();
    }
    public function destroy($kd_fittur){

        // dd($kd_fittur);
        $fittur = DB::table('t_set_fittur')->where ('kd_fittur','=',$kd_fittur)->delete();
        return back()->withInput();

    }
}
