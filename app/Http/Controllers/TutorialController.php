<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'tutorial';
    }
    public function index(Request $request)
    {
        $modul = $this->modul;
        $data = [
            'view' => 'tutorial.index',
            'data' =>
            [
                'label' => 'Tutorial',
                'modul' => 'tutorial',
                'tutorial' =>Tutorial::all(),
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function create()
    {
        # code...
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'menu' => 'required',
            'link' => 'required',
        ]);
        $post = Tutorial::create([
            'menu' => $request->menu,
            'link' => $request->link,
        ]);

        if ($post) {
            return redirect()
                ->route('tutorial.index')
                ->with([
                    'success' => 'Tutorial Berhasil Dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Tutorial Tidak Berhasil Dibuat'
                ]);
        }
    }
    public function edit(Request $request,$id_tutorial)
    {
        // dd($id_tutorial);
        $tutorial = Tutorial::findOrFail($id_tutorial);
        $modul = $this->modul;
        return view('tutorial.edit', compact('modul','tutorial'));
    }
    public function update(Request $request,$id_tutorial){
        $this->validate($request, [
            'menu' => 'required',
            'link' => 'required',
        ]);
        // dd($request->kategori_bisnis);
        $post = Tutorial::findOrFail($id_tutorial);

        $post->update([
            'menu' => $request->menu,
            'link' => $request->link,
        ]);

        if ($post) {
            return redirect()
                ->route('tutorial.index')
                ->with([
                    'success' => 'Kategori Berhasil Diubah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi Sesuatu Masalah, Mohon Coba Lagi'
                ]);
        }
    }
    public function destroy(Request $request,$id_tutorial)
    {
        $post = Tutorial::findOrFail($id_tutorial);
        dd($post);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('tutorial.index')
                ->with([
                    'success' => 'Kategori Berhasil Dihapus'
                ]);
        } else {
            return redirect()
                ->route('tutorial.index')
                ->with([
                    'error' => 'Terjadi Sesuatu Masalah, Mohon Coba Lagi'
                ]);
        }
    }
}
