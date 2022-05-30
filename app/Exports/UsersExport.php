<?php

namespace App\Exports;

use App\Models\tUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UsersExport implements  FromView
// class UsersExport implements fromCollection, FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $now = Carbon::now()->format('y-m-d');

        return view('report.v_reportUserAktif', [
            'userAktif' => DB::table('t_user')
            ->join('t_setting','t_setting.id_user','=','t_user.id_user')
            ->where('t_user.tgl_expired','>=',$now,)
            ->whereIn('t_user.produk_id',['198','175'])
            ->get()
        ]);

    }

    // public function collection()
    // {
    //     $now = Carbon::now()->format('y-m-d');
    //     // $user= DB::table('t_user')->whereDate('is_created','>=',$now)->get();
    //     // $user = DB::table('t_user')
    //     //         ->join('t_setting','t_setting.id_user','=','t_user.id_user')
    //     //         ->where('t_user.tgl_expired','>=',$now,)
    //     //         ->whereIn('t_user.produk_id',['198','175'])
    //     //         ->get();
    //     // return tUser::all();
    //     return DB::table('t_user')
    //             ->join('t_setting','t_setting.id_user','=','t_user.id_user')
    //             ->where('t_user.tgl_expired','>=',$now,)
    //             ->whereIn('t_user.produk_id',['198','175'])
    //             ->get();

    // }
}
