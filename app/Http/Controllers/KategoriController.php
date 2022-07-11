<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'kategori';
    }
    public function index(Request $request){

        $modul = $this->modul;
        $data = [
            'view' => 'kategori.index',
            'data' =>
            [
                'label' => 'Kategori',
                'modul' => 'kategori',
                'kategori' => Kategori::all()
                ]
        ];
        return backend($request,$data,$modul);
    }
    public function create(Request $request)
    {
        alert('Title','Lorem Lorem Lorem', 'success');
        // $modul = $this->modul;
        // $data = [
        //     'view' => 'kategori.create',
        //     'data' =>
        //     [
        //         'label' => 'Kategori',
        //         'modul' => 'kategori',
        //         'kategori' => Kategori::all()
        //         ]
        // ];
        // return backend($request,$data,$modul);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_bisnis' => 'required',
        ]);
        $post = kategori::create([
            'kategori_bisnis' => $request->kategori_bisnis,
        ]);

        if ($post) {
            return redirect()
                ->route('kategori.index')
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
    public function edit(Request $request,$id_kategori_bisnis)
    {
        // dd($id_kategori_bisnis);
        $kategori = Kategori::findOrFail($id_kategori_bisnis);
        $modul = $this->modul;
        return view('kategori.edit', compact('modul','kategori'));
    }
    public function update(Request $request,$id_kategori_bisnis){
        $this->validate($request, [
            'kategori_bisnis' => 'required',
        ]);
        // dd($request->kategori_bisnis);
        $post = kategori::findOrFail($id_kategori_bisnis);

        $post->update([
            'kategori_bisnis' => $request->kategori_bisnis,
        ]);

        if ($post) {
            return redirect()
                ->route('kategori.index')
                ->with([
                    'success' => 'Kategori Kategori Berhasil Diupdate'
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

    public function show(Request $request)
    {
        # code...
    }
    public function destroy(Request $request,$id_kategori_bisnis)
    {
        $post = kategori::findOrFail($id_kategori_bisnis);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('kategori.index')
                ->with([
                    'success' => 'Kategori has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('Kategori.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
