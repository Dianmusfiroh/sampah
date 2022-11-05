<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LogNotifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class SendNotifikasiController extends Controller
{
    protected $modul;
    function __construct()
    {
        $this->modul = 'SendNotification';
    }
    public function index(Request $request){
        $modul = $this->modul;

        $data = [
            'view' => 'v_sendNotification',
            'data' =>
            [
                'label' => 'Kirim Notifikasi',
                'modul' => 'SendNotification',
                'logNotif' => LogNotifikasi::all(),

            ]
        ];
        return backend($request,$data,$modul);
    }
    public function sendNotif(Request $request)
    {

        $token = file_get_contents('https://wbslink.id/apiv2/user/getFirebaseToken?_key=WbsLinkV00');
        $token = json_decode($token);
        $SERVER_API_KEY = 'AAAAgw6zukU:APA91bGeudiO5mTpgJBMp6FZieD--phDenYsNQkSTn6ai_Vm-Gwo7AjUNN_HaUPqDyOF2yYSAfDt0nBJ9V3lk1-8IT1x8qd47Z003pJIZnUqso1pO4oe9bbbRQYQBupk39D97C_CVuXe';
        $data = [
                    "registration_ids" => $token,
                    "notification" => [
                        "title" => $request->title,
                        "body" => $request->desc
                    ]
                ];

        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $post = LogNotifikasi::create([
            'title' => $request->title,
            'description' => $request->desc,
        ]);
        $response = curl_exec($ch);

        response()->json($response,200);

        return redirect()
            ->route('SendNotification.index')
            ->with([
                'success' => 'Notifikasi Dikirim!'
            ]);

    }
    public function sendNotifA(Request $request, $id_log_notif)
    {
        $logNotif = LogNotifikasi::find($id_log_notif);
        $token = file_get_contents('https://wbslink.id/apiv2/user/getFirebaseToken?_key=WbsLinkV00');
        $token = json_decode($token);
        $SERVER_API_KEY = 'AAAAgw6zukU:APA91bGeudiO5mTpgJBMp6FZieD--phDenYsNQkSTn6ai_Vm-Gwo7AjUNN_HaUPqDyOF2yYSAfDt0nBJ9V3lk1-8IT1x8qd47Z003pJIZnUqso1pO4oe9bbbRQYQBupk39D97C_CVuXe';
        $data = [
                    "registration_ids" => $token,
                    "notification" => [
                        "title" => $logNotif->title,
                        "body" => $logNotif->description
                    ]
                ];
                // ,
                //         "click_action" => $request->link,
                //         "icon" => "{{ asset('backend/assets/imgs/theme/ICON LOGO.png')}}",
                //         "content_available" => true,
                //         "priority" => "high",
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
        response()->json($response,200);
        return redirect()
            ->route('SendNotification.index')
            ->with([
                'success' => 'Notifikasi Dikirim!'
            ]);

    }

    // public function store(Request $request)
    // {
    //     dd($request->tipe);
    //     $this->validate($request, [
    //         'desc' => 'required',
    //     ]);
    //     $post = DB::create([
    //         // 'kategori_bisnis' => $request->kategori_bisnis,
    //     ]);

    //     if ($post) {
    //         return redirect()
    //             ->route('kategori.index')
    //             ->with([
    //                 'success' => 'New post has been created successfully'
    //             ]);
    //     } else {
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with([
    //                 'error' => 'Some problem occurred, please try again'
    //             ]);
    //     }
    // }
    public function destroy(Request $request,$id_log_notif)
    {
        $post = LogNotifikasi::findOrFail($id_log_notif);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('SendNotification.index')
                ->with([
                    'success' => 'Log Notifikasi Dihapus'
                ]);
        } else {
            return redirect()
                ->route('SendNotification')
                ->with([
                    'error' => 'Log Notifikasi Gagal Dihapus'
                ]);
        }
    }
}
