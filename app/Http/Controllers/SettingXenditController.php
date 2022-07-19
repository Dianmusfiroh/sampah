<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SetingXendit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class SettingXenditController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'SettingXendit';
    }
    public function updateStatus(Request $request)
    {
        // dd($request->is_blocked);
        $user = SetingXendit::where('id_user',$request->id_user)->first();
        $user->id_user = $request->id_user;
        $user->is_blocked = $request->is_blocked;
        $user->save();
    }
    public function update(Request $request,$id_user)
    {

        // $this->validate($request, [
        //     'pin' => 'required'
        // ]);

        $post = SetingXendit::where('id_user',$id_user)->first();

        $post->update([
            'pin' => NULL,
        ]);

        if ($post) {
            return redirect()
                ->route('akun.show',$id_user)
                ->with([
                    'success' => 'Pin Berhasil Direset'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi Kesalahan, Coba Lagi'
                ]);
        }
    }
}
