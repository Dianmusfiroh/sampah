Query Cadangan
--home Controller --
    $akunA=  DB::table('t_user')
    ->join('t_setting','t_user.id_user','=','t_setting.id_user')
    ->select('t_user.*','t_setting.*')
    ->whereBetween('t_user.tgl_expired', ["$now", "$addWeek"])->get();
    $akun =   DB::table('t_user')
    ->Join('t_setting','t_user.id_user','=','t_setting.id_user')
    ->select('t_user.*','t_setting.nama_toko')
    ->get();
    $json = file_get_contents('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$item[0]->user_id.'&product_id='.$item[0]->produk_id.'');
    $userExpToDay= DB::table('t_user')->whereDate('tgl_expired',$now)->count('id_user'),
    $totalTransaksiRP = $orderTR + $multiOrderTR,
    //total Transaksi
    $orderTR =  DB::table('t_order')
    ->whereMonth('tgl_order', $Month)
    ->where('order_status','4')
    ->sum('totalbayar');
    $multiOrderTR =  DB::table('t_multi_order')
    ->whereMonth('tgl_order', $Month)
    ->where('order_status','4')
    ->sum('totalbayar');
    $totalTransaksiSelesai = DB::table('t_order')->where('order_status','4')->count('id_order')+ DB::table('t_multi_order')->where('order_status','4')->count('id_order'),
    //end total transaction
    $bestSellerperbulan= DB::select(DB::raw('SELECT p.id_user,t.id_produk ,p.nama_produk,p.gambar ,sum(total) as jumlah, pl.link from ( SELECT a.id_produk , COUNT(a.id_produk) as total FROM (SELECT k.id_user, k.id_produk FROM t_keranjang k JOIN t_multi_order mo WHERE k.kode_keranjang = mo.kode_keranjang AND month(tgl_selesai)=month(now()) AND year(tgl_selesai)= year(now())) AS a GROUP BY a.id_produk UNION ALL SELECT id_produk,COUNT(id_produk) AS total FROM t_order o WHERE month(o.tgl_selesai)= month(now()) AND year(o.tgl_selesai) =year(now()) GROUP BY id_produk) AS t JOIN t_produk p JOIN t_produk_link pl WHERE pl.id_produk = t.id_produk AND p.id_produk = t.id_produk GROUP BY t.id_produk ORDER BY total DESC limit 5')),
