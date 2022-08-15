<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fittur;
use Illuminate\Support\Facades\DB;

class FitturController extends Controller
{
    protected $modul;
    protected $date;
    function __construct()
    {
        $this->modul = 'fittur';
    }
    public function index(Request $request){
        $modul = $this->modul;
        $data = [
            'view' => 'fittur.index',
            'data' =>
            [
                'label' => 'Fittur',
                'modul' => 'fittur',
                'Fittur' => Fittur::all(),
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function store(Request $request)
    {
        // dd($request->fittur);
        $this->validate($request, [
            'fittur' => 'required',
            'harga'=>'required',
        ]);
        $post = Fittur::create([
            'fittur' => $request->fittur,
            'harga' => $request->harga,
        ]);


        if ($post) {
            return redirect()
                ->route('fittur.index')
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
    public function destroy($id_fittur){
        $fittur = DB::table('t_fittur')->where ('id_fittur','=',$id_fittur)->delete();
        return back()->withInput();
    }
    public function edit(Request $request,$id_fittur)
    {
        $fittur = Fittur::findOrFail($id_fittur);
        $modul = $this->modul;
        return view('fittur.edit', compact('modul','fittur'));
    }
    public function update(Request $request,$id_fittur){
        $this->validate($request, [
            'fittur' => 'required',
            'harga' => 'required',
        ]);
        // dd($request->kategori_bisnis);
        $post = Fittur::findOrFail($id_fittur);

        $post->update([
            'fittur' => $request->fittur,
            'harga' => $request->harga,
        ]);

        if ($post) {
            return redirect()
                ->route('fittur.index')
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

}
