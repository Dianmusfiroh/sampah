<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAksesControlller extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'SetUser';
    }
    public function index(Request $request)
    {
        $modul = $this->modul;
        $data = [
            'view' => 'v_userAkses',
            'data' =>
            [
                'modul' => 'SetUser',
                'label' => 'User Akses',
                'user' => User::all(),

                ]
            ];
        return backend($request,$data,$modul);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $post = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($post) {
            return redirect()
                ->route('SetUser.index')
                ->with([
                    'success' => 'User Akses Berhasil Dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'User Akses Gagal Dibuat'
                ]);
        }
    }
    public function edit(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $modul = $this->modul;
        return view('v_userAksesEdit', compact('modul','user'));
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        // dd($request->kategori_bisnis);
        $post = User::findOrFail($id);

        $post->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($post) {
            return redirect()
                ->route('SetUser.index')
                ->with([
                    'success' => 'User Akses  Berhasil Diupdate'
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
    public function destroy(Request $request,$id)
    {
        $post = User::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('SetUser.index')
                ->with([
                    'success' => 'User Access has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('SetUser.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
