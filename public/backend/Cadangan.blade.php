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
--JS statistik barang--
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
{{--  <script type="module" src="{{ asset('backend/assets/js/vendors/utils.js')}}"></script>  --}}
{{--  <script>
    var selesai = [@php echo $chrtSelesai @endphp];
    var chrtProses = [@php echo $chrtProses @endphp];
    var chrtPemesanan = [@php echo $chrtPemesanan @endphp];

    console.log(selesai);
    if ($('#myChart4').length) {
        var ctx = document.getElementById('myChart4').getContext('2d');
        //const labels = Utils.months({count: 7});

        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
               // labels: labels,
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Selesai',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(400, 197, 198, 0.44)',
                        borderColor: 'rgb(255, 77, 77)',
                        data: selesai
                    },
                    {
                        label: 'Pesanan',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(44, 120, 220, 0.2)',
                        borderColor: 'rgba(44, 120, 220)',
                        data: chrtPemesanan
                    },
                    {
                        label: 'Proses',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(4, 209, 130, 0.2)',
                        borderColor: 'rgb(4, 209, 130)',
                        data: chrtProses
                    }


                ]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                        },
                    }
                }
            }
        });
    } //End if
</script>  --}}
<script>
    var selesai = [@php echo $chrtSelesai @endphp];
    var chrtProses = [@php echo $chrtProses @endphp];
    var chrtPemesanan = [@php echo $chrtPemesanan @endphp];
    {{--  var namaBulan = [@php echo $namaBulan @endphp];  --}}
    var namaBulan = ["January","February","March","April","May","June",];

    const TrafficMonth = namaBulan.map((month,index) =>{
        let monthObject = {};
        monthObject.month = month;
        monthObject.chrt ={};
        monthObject.chrt.selesai = selesai[index];
        return monthObject;
    });
    namaBulan.forEach(consoleItem);
    function consoleItem(item, index, arr){
        const day =[
        {x:Date.parse('item'),y: 18},
    ];

    };
    var test = function(f){

        console.log(f);
    };
    const la = namaBulan.map(function(e){
        return e;
        });
        const ly = selesai.map(function(e){
            return e;
            });

console.log({la,ly});



    const month =[
        {x:Date.parse('2022-1-2'),y: 8},
        {x:Date.parse('2022-2-3'),y: 19},
        {x:Date.parse('2022-3-4'),y: 2},
        {x:Date.parse('2022-4-5'),y: 4},
        {x:Date.parse('2022-5-6'),y: 12},
    ];


    const ctx = document.getElementById('myChart7').getContext('2d');


    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: la,
            datasets: [{
                label: "Pesanan",
                backgroundColor: "#5897fb",
                barThickness: 10,
                data: selesai

            },
            {{--  {
                label: "Proses",
                backgroundColor: "#fb5858",
                barThickness: 10,
                data: day
            },
            {
                label: "Selesai",
                backgroundColor: "#33FF57",
                barThickness: 10,
                data: day
            }  --}}
            ]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                    },
                }
            },
            scales: {
                {{--  x:{
                    type: 'time',
                    time:{
                        unit:'day'
                    }
                },  --}}
                y: {
                    beginAtZero: true
                }
            }
        }

    });
    function timeFrame(period){
        {{--  console.log(period.value)  --}}
        if(period.value == 'day'){
            {{--  myChart.options.scales.x.time.unit =period.value;  --}}
            myChart.data.datasets[0].data = day;
        }
        if(period.value == 'month'){
            {{--  myChart.options.scales.x.time.unit =period.value;  --}}
            myChart.data.datasets[0].data = month;
        }
        myChart.update();
    }
    </script>
    day +=JSON.stringify({x:TrafficMonth[i].month,y: TrafficMonth[i].chrt.selesai})+",";
--Data statistik 2 --------------------
<script>
    const selesai = [@php echo $chrtSelesai @endphp];
    const chrtProses = [@php echo $chrtProses @endphp];
    const chrtPemesanan = [@php echo $chrtPemesanan @endphp];
    const namaBulan = [@php echo $namaBulan @endphp];

    const TrafficMonth = namaBulan.map((month,index) =>{
        let monthObject = {};
        monthObject.month = month;
        monthObject.chrt ={};
        monthObject.chrt.selesai = selesai[index];
        return monthObject;
    });
    let hasil = "";
    let x = "";
    let y = "";
    for (let i = 0; i < TrafficMonth.length; i++) {
        {{--  day +=JSON.stringify({x:TrafficMonth[i].month,y: TrafficMonth[i].chrt.selesai})+",";  --}}
        x = TrafficMonth[i].month;
        y = TrafficMonth[i].chrt.selesai;
        hasil = "x"+":"+x+","+"y"+":"+y;
    };
    const h = [hasil];
    console.log(TrafficMonth);
    {{--  let day3 =Array.parse(day);  --}}
    {{--  const fruits = [{"Banana"},{ "Orange"}, {"Apple"}, {"Mango"}];  --}}
    console.log(namaBulan);

    let day2 =[
        {"x":"jan","y": "1"},
        {"x":"feb","y": "3"},
        {"x":"maret","y": "6"},
    ];
    let day1 =[
        {"x":"jan","y": "1"},
        {"x":"feb","y": "3"},
        {"x":"maret","y": "6"},
    ];
    console.log(day2)
    console.log(day1)
    const month =[
        {x:Date.parse('2022-1-1'),y: 8},
        {x:Date.parse('2022-2-1'),y: 19},
        {x:Date.parse('2022-3-1'),y: 2},
        {x:Date.parse('2022-4-1'),y: 4},
        {x:Date.parse('2022-5-1'),y: 12},
    ];
    const month2 =[
        {x:Date.parse('2022-1-1'),y: 8},
        {x:Date.parse('2022-2-1'),y: 19},
        {x:Date.parse('2022-3-1'),y: 2},
        {x:Date.parse('2022-4-1'),y: 4},
        {x:Date.parse('2022-5-1'),y: 12},
    ];
    const ctx = document.getElementById('myChart7').getContext('2d');


    const myChart = new Chart(ctx, {
        async: false,
        type: 'bar',
        data: {
            datasets: [{
                label: "Pesanan",
                backgroundColor: "#5897fb",
                barThickness: 10,
                tension: 0.3,
                data: TrafficMonth
                parsing:{
                    yAxisKey: 'namaBulan'
                }
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                    },
                }
            },
            scales: {
                {{--  x:{
                    type: 'time',
                    time:{
                        unit:'day'
                    }
                },  --}}
                y: {
                    beginAtZero: true
                }
            }
        }

    });
    function timeFrame(period){
        if(period.value == 'day'){
            {{--  myChart.options.scales.x.time.unit =period.value;  --}}
            myChart.data.datasets[0].data = day;
            myChart.data.datasets[1].data = day2;
        }
        if(period.value == 'month'){
            {{--  myChart.options.scales.x.time.unit =period.value;  --}}
            myChart.data.datasets[0].data = month;
            myChart.data.datasets[1].data = month2;

        }
        if(period.value == 'year'){
            {{--  myChart.options.scales.x.time.unit =period.value;  --}}
            myChart.data.datasets[0].data = month;
            myChart.data.datasets[1].data = month2;
        }
        myChart.update();
    }
    </script>
----jquery API link----
$('#dataExp').click(function() {

    var id_user = 'ada';
    var user_id = $(this).data('uid');
    alert (id_user);

fetch ('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id=user_id&product_id=175')
.then(x => x.text())
.then(y => document.getElementById("demo").innerHTML = y);

})

