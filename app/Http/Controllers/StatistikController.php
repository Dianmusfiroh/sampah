<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Http\Message\RequestInterface;
use Illuminate\Support\Facades\Http;
// use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\DataTables;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $Month = Carbon::now()->format('m');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        // $t = $this->get_Chart_Pemesanan;
        // dd($t);
        //week
        $weekTotal = DB::select('SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order, YEARWEEK(tgl_order) FROM `t_multi_order` WHERE YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE()) UNION ALL SELECT tgl_order as total, tgl_order, YEARWEEK(tgl_order) FROM `t_order` WHERE YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE())) AS a GROUP by day(a.tgl_order) ORDER BY a.tgl_order');
        $weekSelesai = DB::select('SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order, YEARWEEK(tgl_order) FROM `t_multi_order` WHERE order_status = "4" AND YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE()) UNION ALL SELECT tgl_order as total, tgl_order, YEARWEEK(tgl_order) FROM `t_order` WHERE order_status = "4" AND YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE())) AS a GROUP by day(a.tgl_order) ORDER by a.tgl_order');
        $weekTerkirim = DB::select('SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order, YEARWEEK(tgl_order) FROM `t_multi_order` WHERE order_status = "3" AND YEARWEEK(tgl_order) = YEARWEEK(NOW()) AND DAYOFWEEK(CURDATE()) UNION ALL SELECT tgl_order as total, tgl_order, YEARWEEK(tgl_order) FROM `t_order` WHERE order_status = "3" AND YEARWEEK(tgl_order) = YEARWEEK(NOW())  AND DAYOFWEEK(CURDATE())) AS a GROUP by day(a.tgl_order) ORDER BY a.tgl_order');
        $chrtWeekSelesai = '';
        $chrtWeekTerkirim = '';
        $chrtWeekTotal = '';
        $namaHariSelesai = '';
        $namaHariTotal = '';
        $namaHariTerkirim = '';
        foreach ($weekTotal as $item) {
            $chrtWeekTotal .= $item->total . ',';
            // $namaHariTotal .= '"'.$item->tgl_order.'"'.',';
            $namaHariTotal .= '"' . Carbon::parse($item->tgl_order)->isoFormat('dddd') . '"' . ',';
        }
        foreach ($weekSelesai as $item) {
            $chrtWeekSelesai .= $item->total . ',';
            // $namaHariSelesai .= '"'.$item->tgl_order.'"'.',';
            $namaHariSelesai .= '"' . Carbon::parse($item->tgl_order)->isoFormat('dddd') . '"' . ',';
        }
        foreach ($weekTerkirim as $item) {
            $chrtWeekTerkirim .= $item->total . ',';
            // $namaHariTerkirim .= '"'.$item->tgl_order.'"'.',';
            $namaHariTerkirim .= '"' . Carbon::parse($item->tgl_order)->isoFormat('dddd') . '"' . ',';
        }
        //month
        $bulanSelesai = DB::select('SELECT COUNT(a.total) AS total, a.bulan ,a.namabulan FROM (SELECT id_order AS total, monthname(tgl_order) AS namabulan,month(tgl_order) AS bulan FROM `t_multi_order` WHERE order_status="4" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) UNION SELECT id_order AS total, monthname(tgl_order) AS namabulan,month(tgl_order) AS bulan FROM `t_order` WHERE order_status="4" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) )AS a GROUP BY bulan');
        $bulanProses = DB::select('SELECT COUNT(a.total) AS total, a.bulan ,a.namabulan FROM (SELECT id_order AS total, month(tgl_order) AS bulan , monthname(tgl_order) AS namabulan FROM `t_multi_order` WHERE order_status="3" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) UNION SELECT id_order AS total, month(tgl_order) AS bulan, monthname(tgl_order) AS namabulan FROM `t_order` WHERE order_status="3" AND month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) )AS a GROUP BY bulan');
        $bulanPemesanan = DB::select('SELECT COUNT(a.total) AS total, a.bulan ,a.namabulan FROM (SELECT id_order AS total, month(tgl_order) AS bulan, monthname(tgl_order) AS namabulan FROM `t_multi_order` WHERE   month(tgl_order) = month(tgl_order) AND year(tgl_order)= year(tgl_order) UNION SELECT id_order AS total, month(tgl_order) AS bulan , monthname(tgl_order) AS namabulan FROM `t_order` WHERE month(tgl_order) = month(tgl_order)  AND year(tgl_order)= year(tgl_order) )AS a GROUP BY bulan');
        $namaBulan = '';
        $chrtSelesai = '';
        $chrtProses = '';
        $chrtPemesanan = '';
        $prosesBulan = '';
        $pemesananBulan = '';
        foreach ($bulanSelesai as $item) {
            $chrtSelesai .= $item->total . ',';
            $namaBulan .= '"' . $item->namabulan . '"' . ',';
            // $namaBulan .= '"'.Carbon::parse($item->bulan)->isoFormat('MMMM').'"'.',';


        }
        foreach ($bulanProses as $item) {
            $chrtProses .= $item->total . ',';
            $prosesBulan .= '"' . $item->namabulan . '"' . ',';
            // $prosesBulan .= '"'.Carbon::parse($item->bulan)->isoFormat('MMMM').'"'.',';

        }
        foreach ($bulanPemesanan as $item) {
            $chrtPemesanan .= $item->total . ',';
            $pemesananBulan .= '"' . $item->namabulan . '"' . ',';
            // $pemesananBulan .= '"'.Carbon::parse($item->bulan)->isoFormat('MMMM').'"'.',';

        }

        //year
        $tahunSelesai = DB::select('SELECT count(a.total) AS total, a.tahun AS tahun FROM (SELECT id_order AS total, year(tgl_order) AS tahun FROM `t_order` WHERE order_status="4" UNION ALL SELECT id_order AS total, year(tgl_order) FROM `t_multi_order` WHERE order_status="4" )AS a GROUP BY a.tahun');
        $tahunProses = DB::select('SELECT count(a.total) AS total, a.tahun AS tahun FROM (SELECT id_order AS total, year(tgl_order) AS tahun FROM `t_order` WHERE order_status="3" UNION ALL SELECT id_order AS total, year(tgl_order) FROM `t_multi_order` WHERE order_status="3" )AS a GROUP BY a.tahun');
        $tahunPemesanan = DB::select('SELECT count(a.total) AS total, a.tahun AS tahun FROM (SELECT id_order AS total, year(tgl_order) AS tahun FROM `t_order`  UNION ALL SELECT id_order AS total, year(tgl_order) FROM `t_multi_order`)AS a GROUP BY a.tahun');
        $namaTahunSelesai = '';
        $namaTahunProses = '';
        $namaTahunPemesanan = '';
        $chartTahunSelesai = '';
        $chartTahunProses = '';
        $chartTahunPemesanan = '';
        foreach ($tahunSelesai as $item) {
            $chartTahunSelesai .= $item->total . ',';
            $namaTahunSelesai .= '"' . $item->tahun . '"' . ',';
        }
        foreach ($tahunProses as $item) {
            $chartTahunProses .= $item->total . ',';
            $namaTahunProses .= '"' . $item->tahun . '"' . ',';
        }
        foreach ($tahunPemesanan as $item) {
            $chartTahunPemesanan .= $item->total . ',';
            $namaTahunPemesanan .= '"' . $item->tahun . '"' . ',';
        }
        $orderTR =  DB::table('t_order')
            ->whereMonth('tgl_order', $Month)
            ->where('order_status', '4')
            ->groupBy('id_user')
            ->get();
        $multiOrderTR =  DB::table('t_multi_order')
            ->whereMonth('tgl_order', $Month)
            ->where('order_status', '4')
            ->groupBy('tgl_order')
            ->get();
        // @dump($multiOrderTR);
        // die();
        $data = [
            'view' => 'statistik.v_statistik',
            'data' =>
            [
                'label' => 'Statistik',
                //bulan
                'chrtSelesai' => $chrtSelesai,
                'chrtProses' => $chrtProses,
                'chrtPemesanan' => $chrtPemesanan,
                'namaBulan' => $namaBulan,
                'prosesBulan' => $prosesBulan,
                'pemesananBulan' => $pemesananBulan,
                //tahun
                'chartTahunSelesai' => $chartTahunSelesai,
                'chartTahunProses' => $chartTahunProses,
                'chartTahunPemesanan' => $chartTahunPemesanan,
                'namaTahunSelesai' =>  $namaTahunSelesai,
                'namaTahunProses' => $namaTahunProses,
                'namaTahunPemesanan' => $namaTahunPemesanan,
                //minggu
                'chrtWeekSelesai' => $chrtWeekSelesai,
                'chrtWeekTerkirim' => $chrtWeekTerkirim,
                'chrtWeekTotal' => $chrtWeekTotal,
                'namaHariTotal' => $namaHariTotal,
                'namaHariSelesai' => $namaHariSelesai,
                'namaHariTerkirim' => $namaHariTerkirim,
            ]
        ];
        return backend($request, $data);
    }

    public function statistikMember(Request $request)
    {
        $members = DB::select('SELECT a.nama_provinsi, sum(total) as jumlah , a.prov FROM(SELECT s.prov,s.kab,p.nama_provinsi, k.nama_kabupaten , COUNT(DISTINCT nama_toko) as total FROM `t_setting` s LEFT JOIN m_provinsi p ON s.prov = p.id LEFT JOIN m_kabupaten k ON s.kab = k.id WHERE nama_toko != "" GROUP BY 1,2,3,4) AS a GROUP BY 1;');

        $data = [
            'view' => 'statistik.v_statistikMember',
            'data' =>
            [
                'label' => 'Statistik Member',
                'member' => $members,

            ]
        ];
        return backend($request, $data);
    }
    public function getStudents(Request $request)
    {

        $members = DB::select('SELECT a.nama_provinsi, sum(total) as jumlah , a.prov FROM(SELECT s.prov,s.kab,p.nama_provinsi, k.nama_kabupaten , COUNT(DISTINCT nama_toko) as total FROM `t_setting` s LEFT JOIN m_provinsi p ON s.prov = p.id LEFT JOIN m_kabupaten k ON s.kab = k.id WHERE nama_toko != "" GROUP BY 1,2,3,4) AS a GROUP BY 1;');


        return DataTables::of($members)
            ->addIndexColumn()
            ->make(true);
    }
    public function memberViewKab(Request $request)
    {
        $kab = DB::select("SELECT s.id_user,s.nama_toko, s.alamat_toko, s.no_hp_toko, s.prov , s.kab,k.nama_kabupaten , u.user_id, u.produk_id FROM t_setting s, t_user u ,m_kabupaten k WHERE k.id= s.kab AND s.id_user = u.id_user AND s.prov = $request->idProv");
        echo json_encode($kab);
        // $members = DB::select('SELECT a.nama_provinsi, sum(total) as jumlah , a.prov FROM(SELECT s.prov,s.kab,p.nama_provinsi, k.nama_kabupaten , COUNT(DISTINCT nama_toko) as total FROM `t_setting` s LEFT JOIN m_provinsi p ON s.prov = p.id LEFT JOIN m_kabupaten k ON s.kab = k.id WHERE nama_toko != "" GROUP BY 1,2,3,4) AS a GROUP BY 1;');

        // return DataTables::of($kab)
        // ->addIndexColumn()
        // ->make(true);

    }
    public function rajaOngkirKabupaten($cityId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=$cityId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: aplicaton/json",
                "key: 739f0fb277b8be3c8eb812b552467ea0"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Tidak Ditemukan";
        } else {
            $tes = json_decode($response);
            // echo '<pre>';
            if (empty($tes->rajaongkir->results)) {
                return "Data Lainnya";
            } else {
                return $tes->rajaongkir->results->city_name;
            }
            // echo '</pre>';
        }
    }
    public function rajaOngkirProvinsi($provId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pro.rajaongkir.com/api/province?id=$provId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: aplicaton/json",
                "key: 739f0fb277b8be3c8eb812b552467ea0"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Tidak Ditemukan";
        } else {
            $tes = json_decode($response);
            // echo '<pre>';
            if (empty($tes->rajaongkir->results)) {
                return "Data Lainnya";
            } else {
                return $tes->rajaongkir->results->province;
            }

            // echo '</pre>';
        }
    }
    public function getProvince()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: aplicaton/json",
                "key: 739f0fb277b8be3c8eb812b552467ea0"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Tidak Ditemukan";
        } else {
            $tes = json_decode($response);
            $provinces = $tes->rajaongkir->results;

            foreach ($provinces as $item) {
                DB::insert('insert into m_provinsi (id, nama_provinsi) values (?, ?)', [$item->province_id, $item->province]);
            };
        }
    }
    public function getKabupaten()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pro.rajaongkir.com/api/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: aplicaton/json",
                "key: 739f0fb277b8be3c8eb812b552467ea0"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Tidak Ditemukan";
        } else {
            $tes = json_decode($response);
            $city = $tes->rajaongkir->results;
            foreach ($city as $item) {
                DB::insert('insert into m_kabupaten (id,prov_id , nama_kabupaten) values (?, ?,?)', [$item->city_id, $item->province_id, $item->city_name]);
            };
        }
    }
    public function apiAlamat(Request $request)
    {
        // dd($request->)
        $response = Http::withHeaders([
            'key' => '739f0fb277b8be3c8eb812b552467ea0',
        ])
            ->get('https://pro.rajaongkir.com/api/subdistrict?', [
                'city' => '130',
            ]);
        echo json_encode($response);
        // }

    }
    public function statistikJenisUsaha(request $request)
    {
        $dataJU    = DB::table('t_setting')
            ->join('t_kategori_bisnis', 't_setting.id_kategori_bisnis', '=', 't_kategori_bisnis.id_kategori_bisnis')
            ->select('t_setting.id_kategori_bisnis', 't_setting.id_user', 't_kategori_bisnis.kategori_bisnis')
            ->addSelect(DB::raw('COUNT("t_setting.id_user") as total'))
            ->groupBy(DB::raw('t_setting.id_kategori_bisnis'))
            ->get();

        $namaKU = '';
        $chrtTotal = '';

        foreach ($dataJU as $item) {
            $chrtTotal .= '"' . $item->total . '"' . ',';
            $namaKU .= '"' . $item->kategori_bisnis . '"' . ',';
        }
        $data = [
            'view' => 'statistik.v_statistikJenisUsaha',
            'data' =>
            [
                'label'     => 'Statistik Jenis Usaha',
                'namaKU'     => $namaKU,
                'chrtTotal' => $chrtTotal,
                'dataJenisUsaha' => $dataJU,

            ]
        ];
        return backend($request, $data);
    }
    public function getDetailStatistikJenisUsaha(Request $request)
    {
        $detail    = DB::table('t_setting')
            ->join('t_kategori_bisnis', 't_setting.id_kategori_bisnis', '=', 't_kategori_bisnis.id_kategori_bisnis')
            ->join('t_user', 't_setting.id_user', '=', 't_user.id_user')
            ->select('t_setting.id_kategori_bisnis', 't_setting.id_user', 't_user.user_id', 't_user.produk_id', 't_setting.alamat_toko', 't_setting.no_hp_toko', 't_setting.nama_toko', 't_kategori_bisnis.kategori_bisnis')
            ->where('t_setting.id_kategori_bisnis', $request->id_kategori_bisnis)
            ->get();
        echo json_encode($detail);
    }
    public function getDataTransaksi(Request $request)
    {
        $dataTransaksi = DB::select("SELECT SUM(total) as total, id_user FROM (SELECT COUNT(*) AS total, id_user FROM t_multi_order WHERE id_user = $request->id_user UNION ALL SELECT COUNT(*) as total ,id_user FROM t_order WHERE id_user = $request->id_user) AS a;");
        echo json_encode($dataTransaksi);
    }

    public function get_Pemesanan(Request $request)
    {
        $pesanan = DB::select("SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT id_order AS total, tgl_order FROM `t_multi_order` WHERE date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT id_order as total, tgl_order FROM `t_order` WHERE date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') ) AS a ORDER BY a.tgl_order;");
        echo json_encode($pesanan);
    }
    public function get_Dikirim(Request $request)
    {
        $dikirim = DB::select("SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order FROM `t_multi_order` WHERE order_status = '3' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT tgl_order as total, tgl_order FROM `t_order` WHERE order_status = '3' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') ) AS a  ORDER BY a.tgl_order;");
        echo json_encode($dikirim);
    }
    public function get_Selesai(Request $request)
    {
        $selesai = DB::select("SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order FROM `t_multi_order` WHERE order_status = '4' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT tgl_order as total, tgl_order FROM `t_order` WHERE order_status = '4' AND date(tgl_order) BETWEEN date('$request->start') AND date('$request->end') ) AS a  ORDER BY a.tgl_order;");
        echo json_encode($selesai);
    }
    public function getDate(Request $request)
    {

        $start = $request->start;
        $end = $request->end;

        $this->get_Chart_Pemesanan($start, $end);
    }

    public function get_Chart_Pemesanan($start, $end)
    {

        $pesanan = DB::select("SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order FROM `t_multi_order` WHERE  date(tgl_order) BETWEEN date('$start') AND date('$end') UNION ALL SELECT tgl_order as total, tgl_order FROM `t_order` WHERE date(tgl_order) BETWEEN date('$start') AND date('$end') ) AS a GROUP BY day(a.tgl_order) ORDER BY a.tgl_order;");

        // $pesanan = DB::select("SELECT count(a.total) AS total, a.tgl_order FROM ( SELECT tgl_order AS total, tgl_order FROM `t_multi_order` WHERE  date(tgl_order) BETWEEN date('2022-08-01') AND date('2022-08-10') UNION ALL SELECT tgl_order as total, tgl_order FROM `t_order` WHERE date(tgl_order) BETWEEN date('2022-08-01') AND date('2022-08-10') ) AS a GROUP BY day(a.tgl_order) ORDER BY a.tgl_order;");

        // return $pesanan;
        echo json_encode($pesanan);
    }
    public function postTable(Request $request)
    {
        $pesanan = DB::select("SELECT count(a.total) AS total, a.is_created FROM ( SELECT is_created AS total, is_created FROM `t_multi_order` WHERE  date(is_created) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT is_created as total, is_created FROM `t_order` WHERE date(is_created) BETWEEN date('$request->start') AND date('$request->end') ) AS a GROUP BY day(a.is_created) ORDER BY a.is_created;");
        // $pesanan = DB::select("SELECT count(a.total) AS total, a.is_created FROM ( SELECT is_created AS total, is_created FROM `t_multi_order` WHERE  date(is_created) BETWEEN date('2022-08-01') AND date('2022-08-05') UNION ALL SELECT is_created as total, is_created FROM `t_order` WHERE date(is_created) BETWEEN date('2022-08-01') AND date('2022-08-05') ) AS a GROUP BY day(a.is_created) ORDER BY a.is_created;");
        $dikirim = DB::select("SELECT count(a.total) AS total, a.is_created FROM ( SELECT is_created AS total, is_created FROM `t_multi_order` WHERE order_status = '3' AND date(is_created) BETWEEN date('2022-08-01') AND date('2022-08-5') UNION ALL SELECT is_created as total, is_created FROM `t_order` WHERE order_status = '3' AND date(is_created) BETWEEN date('2022-08-01') AND date('2022-08-05') ) AS a ORDER BY a.is_created;");
        $selesai = DB::select("SELECT count(a.total) AS total, a.is_created FROM ( SELECT is_created AS total, is_created FROM `t_multi_order` WHERE order_status = '4' AND date(is_created) BETWEEN date('2022-08-1') AND date('2022-08-5') UNION ALL SELECT is_created as total, is_created FROM `t_order` WHERE order_status = '4' AND date(is_created) BETWEEN date('2022-08-1') AND date('2022-08-5') ) AS a ORDER BY a.is_created;");



        return DataTables::of($pesanan)
            ->addIndexColumn()
            ->addColumn('dikirim', function ($row, Request $request) {
                $ttlDikirim = "";
                $dikirimm = DB::select("SELECT count(a.total) AS total ,is_created FROM ( SELECT tgl_order AS total, is_created FROM `t_multi_order` WHERE order_status = '3' AND date(is_created) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT is_created as total, is_created FROM `t_order` WHERE order_status = '3' AND date(is_created) BETWEEN date('$request->start') AND date('$request->end') ) AS a GROUP BY a.is_created ORDER BY a.is_created ");
                foreach ($dikirimm as $k) {
                    if ($k->is_created == $row->is_created) {
                        $ttlDikirim .= "<td>$k->total</td><br>";
                    } else {
                        $ttlDikirim;
                    }
                }
                return $ttlDikirim;
            })
            ->rawColumns(['dikirim'])
            ->addColumn('action', function ($row, Request $request) {
                $ttl = "";
                $selesaii = DB::select("SELECT count(a.total) AS total ,is_created FROM ( SELECT tgl_order AS total, is_created FROM `t_multi_order` WHERE order_status = '4' AND date(is_created) BETWEEN date('$request->start') AND date('$request->end') UNION ALL SELECT is_created as total, is_created FROM `t_order` WHERE order_status = '4' AND date(is_created) BETWEEN date('$request->start') AND date('$request->end') ) AS a GROUP BY a.is_created ORDER BY a.is_created ");
                foreach ($selesaii as $k) {
                    if ($k->is_created == $row->is_created) {
                        $ttl .= "<td>$k->total</td><br>";
                    } else {
                        $ttl;
                    }
                }
                return $ttl;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
