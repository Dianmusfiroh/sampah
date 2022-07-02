<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $label }}</h2>
    </div>
</div>
<div class="row">
    <div class="col-xl-10 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Sale statistics</h5>
                <canvas id="myChart7" width="800" height="300"></canvas>
            </article>
        </div>
    </div>
    <div class="col-xl-2 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <div>
                    <input type="radio" id="week" class="form-check-input" onChange="timeFrame(this)" name="periode" value="week"  checked>
                    <label onChange="timeFrame(this)"  for="week">Minggu</label><br>
                </div>
                <div>
                    <input type="radio" id="month" onChange="timeFrame(this)" name="periode" class="form-check-input" value="month">
                    <label onChange="timeFrame(this)"  for="month">Bulan</label><br>
                </div>
                <div>
                    <input type="radio" id="year" onChange="timeFrame(this)" name="periode" class="form-check-input" value="year">
                    <label onChange="timeFrame(this)"  for="yaer">Tahun</label><br>
                </div>

            </article>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" ></script>

<script>
    //week
    const chrtWeekTotal = [@php echo $chrtWeekTotal @endphp];
    const chrtWeekSelesai = [@php echo $chrtWeekSelesai @endphp];
    const chrtWeekTerkirim = [@php echo $chrtWeekTerkirim @endphp];
    const namaHariSelesai = [@php echo $namaHariSelesai @endphp];
    const namaHariTerkirim = [@php echo $namaHariTerkirim @endphp];
    const namaHariTotal = [@php echo $namaHariTotal @endphp];
    var unionHari = [...new Set([...namaHariSelesai, ...namaHariTerkirim, ...namaHariTotal])];

		{{--  console.log(unionHari.sort());  --}}

     //Month
    const selesai = [@php echo $chrtSelesai @endphp];
    const chrtProses = [@php echo $chrtProses @endphp];
    const chrtPemesanan = [@php echo $chrtPemesanan @endphp];
    const namaBulan = [@php echo $namaBulan @endphp];
    const prosesBulan = [@php echo $prosesBulan @endphp];
    const pemesananBulan = [@php echo $pemesananBulan @endphp];
    //year
    const chartTahunSelesai = [@php echo $chartTahunSelesai @endphp];
    const chartTahunProses = [@php echo $chartTahunProses @endphp];
    const chartTahunPemesanan = [@php echo $chartTahunPemesanan @endphp];
    const namaTahunSelesai = [@php echo $namaTahunSelesai @endphp];
    const namaTahunProses = [@php echo $namaTahunProses @endphp];
    const namaTahunPemesanan = [@php echo $namaTahunPemesanan @endphp];

    const TrafficWeek = namaHariTotal.map((week,index) =>{
        let weekObject = {};
        weekObject.week = week;
        weekObject.minggu ={};
        weekObject.minggu.namaHariTerkirim =namaHariTerkirim[index];
        weekObject.minggu.namaHariSelesai =namaHariSelesai[index];
        weekObject.chrt ={};
        weekObject.chrt.chrtWeekTotal = chrtWeekTotal[index];
        weekObject.chrt.chrtWeekSelesai = chrtWeekSelesai[index];
        weekObject.chrt.chrtWeekTerkirim = chrtWeekTerkirim[index];
        return weekObject;
    });
console.log(TrafficWeek);
    const TrafficMonth = namaBulan.map((month,index) =>{
        let monthObject = {};
        monthObject.month = month;
        monthObject.bulan ={};
        monthObject.bulan.prosesBulan =prosesBulan[index];
        monthObject.bulan.pemesananBulan =pemesananBulan[index];
        monthObject.chrt ={};
        monthObject.chrt.selesai = selesai[index];
        monthObject.chrt.chrtProses = chrtProses[index];
        monthObject.chrt.chrtPemesanan = chrtPemesanan[index];
        return monthObject;
    });


    {{--    --}}

    const TrafficTahun = namaTahunSelesai.map((year,index) =>{
        let monthObject = {};
        monthObject.year = year;
        monthObject.tahun ={};
        monthObject.tahun.namaTahunProses = namaTahunProses[index];
        monthObject.tahun.namaTahunPemesanan = namaTahunPemesanan[index];
        monthObject.chrt = {};
        monthObject.chrt.chartTahunSelesai = chartTahunSelesai[index];
        monthObject.chrt.chartTahunProses = chartTahunProses[index];
        monthObject.chrt.chartTahunPemesanan = chartTahunPemesanan[index];
        return monthObject;
    });
    {{--    --}}
    {{--  const TrafficYear = namaTahunSelesai.map((year,index) =>{
        let yearObject = {};
        yearObject.year = year;
        yearObject.tahun = {};
        yearObject.tahun.namaTahunPemesanan = namaTahunPemesanan[index];
        yearObject.tahun.namaTahunProses =namaTahunProses[index];
        yearObject.chrt ={};
        yearObject.chrt.chartTahunSelesai = chartTahunSelesai[index];
        yearObject.chrt.chartTahunProses = chartTahunProses[index];
        yearObject.chrt.chartTahunPemesanan = chartTahunPemesanan[index];
        console.log(yearObject)
        return yearObject;
    });

    console.log(TrafficYear[0].chrt.chartTahunPemesanan)  --}}
    {{--  var union = [...new Set([...namaBulan, ...prosesBulan])];
    console.log(prosesBulan);
    console.log(month)  --}}
    const year =[
        {x:Date.parse('2022-1-2'),y: 8},
        {x:Date.parse('2022-2-3'),y: 19},
        {x:Date.parse('2022-3-4'),y: 2},
        {x:Date.parse('2022-4-5'),y: 4},
        {x:Date.parse('2022-5-6'),y: 12},
    ];

    const data = {
        datasets:
        [
            {
                label: "Pemesanan",
                backgroundColor: "#36e05e",
                barThickness: 10,
                tension: 0.3,
                data: TrafficWeek,
                parsing:{
                    xAxisKey: 'week',
                    yAxisKey: 'chrt.chrtWeekTotal',
                },
            },
            {
                label: "Dikirim",
                backgroundColor: "#fb5858",
                barThickness: 10,
                tension: 0.3,
                data: TrafficWeek,
                parsing:{
                    xAxisKey: 'minggu.namaHariTerkirim',
                    yAxisKey: 'chrt.chrtWeekTerkirim'
                },
            },
            {
                label: "Selesai",
                backgroundColor: "#5897fb",
                barThickness: 10,
                tension: 0.3,
                data: TrafficWeek,
                parsing:{
                        xAxisKey: 'minggu.namaHariSelesai',
                        yAxisKey: 'chrt.chrtWeekSelesai'
                    },
            },
        ]
    };
    {{--  const data = {
        datasets:
        [
            {
                label: "Selesai",
                backgroundColor: "#5897fb",
                barThickness: 10,
                tension: 0.3,
                data: TrafficTahun,
                parsing:{
                    xAxisKey: 'year',
                    yAxisKey: 'chrt.chartTahunSelesai'
                    },
            },
            {
                label: "Proses",
                backgroundColor: "#fb5858",
                barThickness: 10,
                tension: 0.3,
                data: TrafficTahun,
                parsing:{
                    xAxisKey: 'tahun.namaTahunProses',
                    yAxisKey: 'chrt.chartTahunProses'
                },
            },
            {
                label: "Pemesanan",
                backgroundColor: "#36e05e",
                barThickness: 10,
                tension: 0.3,
                data: TrafficTahun,
                parsing:{
                    xAxisKey: 'tahun.namaTahunPemesanan',
                    yAxisKey: 'chrt.chartTahunPemesanan',
                },

            }
        ]
    };  --}}
      // config
    const config = {
        type: 'bar',
        data,
        options: {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                    },
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

      // render init block
    const myChart = new Chart(
        document.getElementById('myChart7'),
        config
    );
    {{--  console.log(myChart.data.datasets[0].parsing.xAxisKey )  --}}

    function timeFrame(period){
        if(period.value == 'week'){


            myChart.data.datasets[0].data = TrafficWeek;
            myChart.data.datasets[0].parsing.xAxisKey = 'week';
            myChart.data.datasets[0].parsing.yAxisKey = 'chrt.chrtWeekTotal';

            myChart.data.datasets[1].data = TrafficWeek;
            myChart.data.datasets[1].parsing.yAxisKey = 'chrt.chrtWeekTerkirim';
            myChart.data.datasets[1].parsing.xAxisKey = 'minggu.namaHariTerkirim';
            myChart.data.datasets[2].data = TrafficWeek;
            myChart.data.datasets[2].parsing.xAxisKey = 'minggu.namaHariSelesai';
            myChart.data.datasets[2].parsing.yAxisKey = 'chrt.chrtWeekSelesai';

        }

        if(period.value == 'month'){
            myChart.data.datasets[0].data = TrafficMonth;
            myChart.data.datasets[0].parsing.xAxisKey = 'bulan.pemesananBulan';
            myChart.data.datasets[0].parsing.yAxisKey = 'chrt.chrtPemesanan';

            myChart.data.datasets[1].data = TrafficMonth;
            myChart.data.datasets[1].parsing.yAxisKey = 'chrt.chrtProses';
            myChart.data.datasets[1].parsing.xAxisKey = 'bulan.prosesBulan';

            myChart.data.datasets[2].data = TrafficMonth;
            myChart.data.datasets[2].parsing.xAxisKey = 'month';
            myChart.data.datasets[2].parsing.yAxisKey = 'chrt.selesai';
        }
        if(period.value == 'year'){

            myChart.data.datasets[0].data = TrafficTahun;
            myChart.data.datasets[0].parsing.xAxisKey = 'tahun.namaTahunPemesanan';
            myChart.data.datasets[0].parsing.yAxisKey = 'chrt.chartTahunPemesanan';
            myChart.data.datasets[1].data = TrafficTahun;
            myChart.data.datasets[1].parsing.yAxisKey = 'chrt.chartTahunProses';
            myChart.data.datasets[1].parsing.xAxisKey = 'tahun.namaTahunProses';
            myChart.data.datasets[2].data = TrafficTahun;
            myChart.data.datasets[2].parsing.xAxisKey = 'year';
            myChart.data.datasets[2].parsing.yAxisKey = 'chrt.chartTahunSelesai';

        }
        myChart.update();
    }
    </script>

