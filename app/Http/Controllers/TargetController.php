<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Target;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'target';
    }
    public function index(Request $request)
    {
        $modul = $this->modul;
        $data = [
            'view' => 'target.index',
            'data' =>
            [
                'label' => 'Target',
                'modul' => 'target',
                'target' =>Target::all(),
            ]
        ];
        return backend($request,$data,$modul);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'pendaftaran' => 'required',
            'transaksi' => 'required',
            'nominal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);
        $post = Target::create([
            'pendaftaran' => $request->pendaftaran,
            'transaksi' => $request->transaksi,
            'nominal' => $request->nominal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);

        if ($post) {
            return redirect()
                ->route('target.index')
                ->with([
                    'success' => 'Target Berhasil Dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Target Tidak Berhasil Dibuat'
                ]);
        }
    }
    public function edit(Request $request,$id_target)
    {
        $target = Target::findOrFail($id_target);
        $modul = $this->modul;
        return view('target.edit', compact('modul','target'));
    }
    public function update(Request $request,$id_target){

        $this->validate($request, [
            'pendaftaran' => 'required',
            'transaksi' => 'required',
            'nominal' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);
        $post = Target::findOrFail($id_target);

        $post->update([
            'pendaftaran' => $request->pendaftaran,
            'transaksi' => $request->transaksi,
            'nominal' => $request->nominal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);

        if ($post) {
            return redirect()
                ->route('target.index')
                ->with([
                    'success' => 'Target Berhasil Diubah'
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
    public function destroy(Request $request,$id_target)
    {
        $post = Target::findOrFail($id_target);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('target.index')
                ->with([
                    'success' => 'Target Berhasil Dihapus'
                ]);
        } else {
            return redirect()
                ->route('target.index')
                ->with([
                    'error' => 'Terjadi Sesuatu Masalah, Mohon Coba Lagi'
                ]);
        }
    }
}
