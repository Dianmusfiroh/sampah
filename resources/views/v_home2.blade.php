<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $label }}</h2>
        <p>Whole data about your business here</p>
    </div>
</div>

<div class="card mb-4" >
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                <select id="layar" class="form-select">
                        <option value="hari" >Hari Ini</option>
                        <option value="kemarin">Kemarin</option>
                        <option value="bulanINI">Bulan ini</option>
                        <option value="bulanKemarin">Bulan Lalu</option>
                        <option value="tahun">Tahun Ini</option>
                </select>
            </div>

        </div>
    </header>
    <!-- card-header end// -->

        <div class="card-body view" id="hari" style="display: block; ">
            <div class="table-responsive">
                <table class="table table-hover " >
                        <tr>
                            <th style="width: 20%">Pengguna</th>
                            <td><a class="text-body" href="{{ route('userAktif') }}">@foreach ($userA as $item )
                                {{ $item->total}}
                            @endforeach</a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{$user->count() }}</a></td>
                        </tr>
                        <tr>
                            <th>Pendaftaran</th>
                            <td><a class="text-body" href="{{ route('detailPendaftaranHariIni') }}">{{$userToDay}}</a></td>
                        </tr>
                        <tr>
                            <th>Transaksi</th>
                            <td><a class="text-body" href="{{ route('detailHariIniNominal') }}">{{$totalTransaksiHariSukses}}</a>/<a class="text-body" href="{{ route('detailTransaksiHariIni') }}">{{$totalTransaksiHari}}</a></td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td><a class="text-body" href="{{ route('detailHariIniNominal') }}">@currency($NominalTransaksiHariSukses)</a></td>
                        </tr>
                </table>
            </div>
        </div>
        <div class="card-body view" id="kemarin" >
            <div class="table-responsive">
            <table class="table table-hover "  >
                    <tr>
                        <th>Pengguna kemarin</th>
                        <td><a class="text-body" href="{{ route('userAktif') }}">@foreach ($userA as $item )
                            {{ $item->total}}
                        @endforeach</a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{$user->count() }}</a></td>
                    </tr>
                    <tr>
                        <th>Pendaftaran</th>
                        <td><a class="text-body" href="{{ route('detailPendaftaranKemarin') }}">{{$userYesterday}}</a></td>
                    </tr>
                    <tr>
                        <th>Transaksi</th>
                        <td><a class="text-body" href="{{ route('detailKemarinNominal') }}">{{$totalTransaksiYesterdaySukses}}</a>/<a class="text-body" href="{{ route('detailTransaksiKemarin') }}">{{$totalTransaksiYesterday}}</a>   </td>
                    </tr>
                    <tr>
                        <th>Nominal</th>
                        <td><a class="text-body" href="{{ route('detailKemarinNominal') }}">@currency($NominalTransaksiYesterdaySukses)</a></td>
                    </tr>
            </table>
            </div>
        </div>
        <div class="card-body view" id="bulanINI" >
            <div class="table-responsive">
            <table class="table table-hover "  >
                    <tr>
                        <th>Pengguna </th>
                        <td><a class="text-body" href="{{ route('userAktif') }}">@foreach ($userA as $item )
                            {{ $item->total}}
                        @endforeach</a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{$user->count() }}</a></td>
                    </tr>
                    <tr>
                        <th>Pendaftaran</th>
                        <td><a class="text-body" href="{{ route('detailPendaftaranBulan') }}">{{$userMonth}}</a></td>
                    </tr>
                    <tr>
                        <th>Transaksi</th>
                        <td><a class="text-body" href="{{ route('detailBulanNominal') }}">{{$totalTransaksiMonthSukses}}</a>/<a class="text-body" href="{{ route('detailTransaksiBulan') }}">{{$totalTransaksiMonth}}</a></td>
                    </tr>
                    <tr>
                        <th>Nominal</th>
                        <td><a class="text-body" href="{{ route('detailBulanNominal') }}">@currency($NominalTransaksiMonthSukses)</a></td>
                    </tr>
            </table>
            </div>
        </div>
        <div class="card-body view" id="bulanKemarin" >
            <div class="table-responsive">
            <table class="table table-hover "  >
                    <tr>
                        <th>Pengguna </th>
                        <td><a class="text-body" href="{{ route('userAktif') }}">@foreach ($userA as $item )
                            {{ $item->total}}
                        @endforeach</a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{$user->count() }}</a></td>
                    </tr>
                    <tr>
                        <th>Pendaftaran</th>
                        <td><a class="text-body" href="{{ route('detailPendaftaranBulanKemarin') }}">{{$userLastMonth}}</a></td>
                    </tr>
                    <tr>
                        <th>Transaksi</th>
                        <td><a class="text-body" href="{{ route('detailBulanLaluNominal') }}">{{$totalTransaksiLastMonthSukses}}</a>/<a class="text-body" href="{{ route('detailTransaksiBulanLalu') }}">{{$totalTransaksiLastMonth}}</a></td>
                    </tr>
                    <tr>
                        <th>Nominal</th>
                        <td><a class="text-body" href="{{ route('detailBulanLaluNominal') }}">@currency($NominalTransaksiLastMonthSukses)</a></td>
                    </tr>
            </table>
            </div>
        </div>
        <div class="card-body view" id="tahun" >
            <div class="table-responsive">
            <table class="table table-hover"  >
                    <tr>
                        <th>Pengguna </th>
                        <td><a class="text-body" href="{{ route('userAktif') }}">@foreach ($userA as $item )
                            {{ $item->total}}
                        @endforeach</a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{$user->count() }}</a></td>
                    </tr>
                    <tr>
                        <th>Pendaftaran</th>
                        <td><a class="text-body" href="{{ route('detailPendaftaranTahun') }}">{{$userYear}}</a></td>
                    </tr>
                    <tr>
                        <th>Transaksi</th>
                        <td><a class="text-body" href="{{ route('detailTahunNominal') }}">{{$totalTransaksiYearSukses}}</a>/<a class="text-body" href="{{ route('detailTotalTahun') }}">{{$totalTransaksiYear}}</a></td>
                    </tr>
                    <tr>
                        <th>Nominal</th>
                        <td > <a class="text-body" href="{{ route('detailTahunNominal') }}"> @currency($NominalTransaksiYearSukses)</a></td>
                    </tr>
            </table>
            </div>
        </div>
</div>
    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Sale statistics</h5>
                    <canvas id="Chart" height="120px"></canvas>
                </article>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="col-lg-12">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-warning-light"><i
                                class="text-warning material-icons md-qr_code"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Products</h6>
                            <span>{{ $produk->count() }}</span>
                            <span class="text-sm"> Jumlah Produk </span>
                        </div>
                    </article>
                </div>
            </div>
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Produk Terbaik</h5>
                        <div class="new-member-list">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach($bestProduk as $key => $item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td><a href="{{ route( 'akun.show', $item->id_user) }}">{{$item->nama_produk}}</a></td>
                                                <td>{{$item->jumlah}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>

        $(function() {
            $('#layar').change(function() {
                $('.view').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>

<script>
var userExp = [@php echo $chart @endphp];
var userActive = [@php echo $chartUser @endphp];
console.log(userActive);
new Chart("Chart", {
    type: "line",

    data: {
    labels: ['Jan', 'Feb', 'Mar','Apr','Mei','Jun','Jul','Ags','Sep','Oct','Nov','Des'],
    datasets: [
       // {
       // label: 'User Expired',
        //tension: 0.3,
        //fill: false,
        //backgroundColor: 'rgba(255, 0, 0, 0.85)',
        //borderColor: 'rgba(255, 0, 0, 0.85)',
        //data: userExp
    //},
    {
        label: 'Pendaftaran',
        tension: 0.3,
        fill: true,
        backgroundColor: 'rgba(4, 209, 130, 0.2)',
        borderColor: 'rgb(4, 209, 130)',
        data: userActive
    }]
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
</script>
