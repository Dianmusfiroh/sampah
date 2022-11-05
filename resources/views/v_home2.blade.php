<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $label }}</h2>
        {{--  <p> {{ Auth::user()->name}}</p>  --}}
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-md-3 col-5 me-auto mb-md-0 mb-3">
                <select id="layar" class="form-select">
                    <option value="hari">Hari Ini</option>
                    <option value="kemarin">Kemarin</option>
                    <option value="bulanINI">Bulan ini</option>
                    <option value="bulanKemarin">Bulan Lalu</option>
                    <option value="tahun">Tahun Ini</option>
                    <option value="custom">Custom</option>
                </select>

            </div>
            <div class="col-md-4 col-1  mb-md-0 mb-3 view" id="customRange">
                <div id="reportrange" class="form-control bg-white ">
                    <i class="material-icons md-calendar_today"></i>&nbsp;
                    <span id="span"></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
    </header>
    <!-- card-header end// -->
    <div class="card-body view" id="hari" style="display: block; ">
        <div class="table-responsive">
            <table class="table table-hover ">
                <tr>
                    <th class="col-md-3">Pengguna</th>
                    <td><a class="text-body" href="{{ route('userAktif') }}">
                            @foreach ($userA as $item)
                                {{ $item->total }}
                            @endforeach
                        </a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{ $user->count() }}</a></td>
                    <td>
                        @if ($targetPengguna < 50)
                            <span class="text-danger">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @else
                            <span class="text-primary">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @endif

                    </td>
                </tr>
                <tr>
                    <th>Pendaftaran</th>
                    <td><a class="text-body" href="{{ route('detailPendaftaranHariIni') }}">{{ $userToDay }}</a>
                    </td>
                    {{--  <td>
                        @if (($userToDay / $targetPendaftaran) * 100 < 50)
                            <span class="text-danger">{{ ($userToDay / $targetPendaftaran) * 100 }}%</span> Dari
                            {{ round($targetPendaftaran) }}
                        @else
                            <span class="text-primary">{{ ($userToDay / $targetPendaftaran) * 100 }}%</span> Dari
                            {{ round($targetPendaftaran) }}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Transaksi</th>
                    <td><a class="text-body"
                            href="{{ route('detailHariIniNominal') }}">{{ $totalTransaksiHariSukses }}</a>/<a
                            class="text-body"
                            href="{{ route('detailTransaksiHariIni') }}">{{ $totalTransaksiHari }}</a></td>
                    {{--  <td>
                        @if (($totalTransaksiHariSukses / $targetTransaksi) * 100 < 50)
                            <span
                                class="text-danger">{{ round(($totalTransaksiHariSukses / $targetTransaksi) * 100) }}%</span>
                            Dari {{ round($targetTransaksi) }}
                        @else
                            <span
                                class="text-primary">{{ round(($totalTransaksiHariSukses / $targetTransaksi) * 100) }}%</span>
                            Dari {{ round($targetTransaksi) }}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>{{ $totalTransaksiHariSukses }}</td>
                    {{--  <td>
                        @if (($NominalTransaksiHariSukses / $targetTransaksi) * 100 < 50)
                            <span
                                class="text-danger">{{ round(($NominalTransaksiHariSukses / $targetTransaksi) * 100) }}%</span>
                            Dari @currency($targetNominal)
                        @else
                            <span
                                class="text-primary">{{ round(($NominalTransaksiHariSukses / $targetTransaksi) * 100) }}%</span>
                            Dari @currency($targetNominal)
                        @endif
                    </td>  --}}
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body view" id="kemarin">
        <div class="table-responsive">
            <table class="table table-hover ">
                <tr>
                    <th class="col-md-3">Pengguna kemarin</th>
                    <td><a class="text-body" href="{{ route('userAktif') }}">
                            @foreach ($userA as $item)
                                {{ $item->total }}
                            @endforeach
                        </a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{ $user->count() }}</a></td>
                    <td>
                        @if ($targetPengguna < 50)
                            <span class="text-danger">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @else
                            <span class="text-primary">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Pendaftaran</th>
                    <td><a class="text-body" href="{{ route('detailPendaftaranKemarin') }}">{{ $userYesterday }}</a>
                    </td>
                    {{--  <td>
                        @if (($userYesterday / $targetPendaftaran) * 100 < 50)
                            <span class="text-danger">{{ ($userYesterday / $targetPendaftaran) * 100 }}%</span> Dari
                            {{ round($targetPendaftaran) }}
                        @else
                            <span class="text-primary">{{ ($userYesterday / $targetPendaftaran) * 100 }}%</span> Dari
                            {{ round($targetPendaftaran) }}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Transaksi</th>
                    <td><a class="text-body"
                            href="{{ route('detailKemarinNominal') }}">{{ $totalTransaksiYesterdaySukses }}</a>/<a
                            class="text-body"
                            href="{{ route('detailTransaksiKemarin') }}">{{ $totalTransaksiYesterday }}</a> </td>
                    {{-- <td>
                            @if ($targetTransaksiKemarin < 50)
                                <span class="text-danger">{{round($targetTransaksiKemarin)}}%</span> Dari {{$targetKemarin->transaksi}}
                            @else
                                <span class="text-primary">{{round($targetTransaksiKemarin)}}%</span> Dari {{$targetKemarin->transaksi}}
                            @endif
                        </td> --}}
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td><a class="text-body" href="{{ route('detailKemarinNominal') }}">@currency($NominalTransaksiYesterdaySukses)</a></td>
                    {{-- <td>
                            @if ($targetNominalTransaksiKemarin < 50)
                                <span class="text-danger">{{round($targetNominalTransaksiKemarin)}}%</span> Dari @currency($targetKemarin->nominal)
                            @else
                                <span class="text-primary">{{round($targetNominalTransaksiKemarin)}}%</span> Dari @currency($targetKemarin->nominal)
                            @endif
                        </td> --}}
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body view" id="bulanINI">
        <div class="table-responsive">
            <table class="table table-hover ">
                <tr>
                    <th class="col-md-3">Pengguna </th>
                    <td><a class="text-body" href="{{ route('userAktif') }}">
                            @foreach ($userA as $item)
                                {{ $item->total }}
                            @endforeach
                        </a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{ $user->count() }}</a></td>
                    <td>
                        @if ($targetPengguna < 50)
                            <span class="text-danger">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @else
                            <span class="text-primary">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Pendaftaran</th>
                    <td><a class="text-body" href="{{ route('detailPendaftaranBulan') }}">{{ $userMonth }}</a></td>
                    {{--  <td>
                        @if (($userMonth / $targetPendaftaranBulan) * 100 < 50)
                            <span class="text-danger">{{ round(($userMonth / $targetPendaftaranBulan) * 100) }}%</span> Dari
                            {{ round($targetPendaftaranBulan) }}
                        @else
                            <span class="text-primary">{{ round(($userMonth / $targetPendaftaranBulan) * 100) }}%</span> Dari
                            {{ round($targetPendaftaranBulan) }}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Transaksi</th>
                    <td><a class="text-body"
                            href="{{ route('detailBulanNominal') }}">{{ $totalTransaksiMonthSukses }}</a>/<a
                            class="text-body"
                            href="{{ route('detailTransaksiBulan') }}">{{ $totalTransaksiMonth }}</a></td>
                    {{--  <td>
                        @if (($totalTransaksiMonthSukses / $targetTransaksiBulan) * 100 < 50)
                            <span class="text-danger">{{ round(($totalTransaksiMonthSukses / $targetTransaksiBulan) * 100 )}}%</span> Dari
                            {{ round($targetTransaksiBulan) }}
                        @else
                            <span class="text-primary">{{ round(($totalTransaksiMonthSukses / $targetTransaksiBulan) * 100 )}}%</span> Dari
                            {{ round($targetTransaksiBulan) }}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td><a class="text-body" href="{{ route('detailBulanNominal') }}">@currency($NominalTransaksiMonthSukses)</a></td>
                    {{--  <td>
                        @if (($NominalTransaksiMonthSukses / $targetNominalBulan) * 100 < 50)
                            <span class="text-danger">{{ round(($NominalTransaksiMonthSukses / $targetNominalBulan) * 100) }}%</span> Dari
                           @currency($targetNominalBulan)
                        @else
                            <span class="text-primary">{{ round(($NominalTransaksiMonthSukses / $targetNominalBulan) * 100) }}%</span> Dari
                            @currency($targetNominalBulan)
                        @endif
                    </td>  --}}
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body view" id="bulanKemarin">
        <div class="table-responsive">
            <table class="table table-hover ">
                <tr>
                    <th class="col-md-3">Pengguna </th>
                    <td><a class="text-body" href="{{ route('userAktif') }}">
                            @foreach ($userA as $item)
                                {{ $item->total }}
                            @endforeach
                        </a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{ $user->count() }}</a></td>
                    {{--  <td>
                            @if ($targetPenggunaBulanLalu < 50)
                                <span class="text-danger">{{round($targetPenggunaBulanLalu)}}%</span> Dari {{$targetBulanKemarin->pengguna}}
                            @else
                                <span class="text-primary">{{round($targetPenggunaBulanLalu)}}%</span> Dari {{$targetBulanKemarin->pengguna}}
                            @endif
                        </td>  --}}
                </tr>
                <tr>
                    <th>Pendaftaran</th>
                    <td><a class="text-body"
                            href="{{ route('detailPendaftaranBulanKemarin') }}">{{ $userLastMonth }}</a></td>
                    {{-- <td>
                            @if ($targetPendaftaranBulanLalu < 50)
                                <span class="text-danger">{{round($targetPendaftaranBulanLalu)}}%</span> Dari {{$targetBulanKemarin->pendaftaran}}
                            @else
                                <span class="text-primary">{{round($targetPendaftaranBulanLalu)}}%</span> Dari {{$targetBulanKemarin->pendaftaran}}
                            @endif
                        </td> --}}
                </tr>
                <tr>
                    <th>Transaksi</th>
                    <td><a class="text-body"
                            href="{{ route('detailBulanLaluNominal') }}">{{ $totalTransaksiLastMonthSukses }}</a>/<a
                            class="text-body"
                            href="{{ route('detailTransaksiBulanLalu') }}">{{ $totalTransaksiLastMonth }}</a></td>
                    {{-- <td>
                            @if ($targetTransaksiBulanLalu < 50)
                                <span class="text-danger">{{round($targetTransaksiBulanLalu)}}%</span> Dari {{$targetBulanKemarin->transaksi}}
                            @else
                                <span class="text-primary">{{round($targetTransaksiBulanLalu)}}%</span> Dari {{$targetBulanKemarin->transaksi}}
                            @endif
                        </td> --}}
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td><a class="text-body" href="{{ route('detailBulanLaluNominal') }}">@currency($NominalTransaksiLastMonthSukses)</a></td>
                    {{-- <td>
                            @if ($targetNominalTransaksiBulanLalu < 50)
                                <span class="text-danger">{{round($targetNominalTransaksiBulanLalu)}}%</span> Dari @currency($targetBulanKemarin->nominal)
                            @else
                                <span class="text-primary">{{round($targetNominalTransaksiBulanLalu)}}%</span> Dari @currency($targetBulanKemarin->nominal)
                            @endif
                        </td> --}}
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body view" id="tahun">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th class="col-md-3">Pengguna </th>
                    <td><a class="text-body" href="{{ route('userAktif') }}">
                            @foreach ($userA as $item)
                                {{ $item->total }}
                            @endforeach
                        </a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{ $user->count() }}</a>
                    </td>
                    <td>
                        @if ($targetPengguna < 50)
                            <span class="text-danger">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @else
                            <span class="text-primary">{{ round($targetPengguna) }}%</span> Dari {{ $user->count() }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Pendaftaran</th>
                    <td><a class="text-body" href="{{ route('detailPendaftaranTahun') }}">{{ $userYear }}</a>
                    </td>
                    {{--  <td>
                        @if (($userYear / $targetPendaftaranTahun) * 100 < 50)
                            <span class="text-danger">{{ round(($userYear / $targetPendaftaranTahun) * 100) }}%</span> Dari
                            {{ round($targetPendaftaranTahun) }}
                        @else
                            <span class="text-primary">{{ round(($userYear / $targetPendaftaranTahun) * 100) }}%</span> Dari
                            {{ round($targetPendaftaranTahun) }}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Transaksi</th>
                    <td><a class="text-body"
                            href="{{ route('detailTahunNominal') }}">{{ $totalTransaksiYearSukses }}</a>/<a
                            class="text-body" href="{{ route('detailTotalTahun') }}">{{ $totalTransaksiYear }}</a>
                    </td>
                    {{--  <td>
                        @if (($totalTransaksiYear / $targetTransaksiTahun) * 100 < 50)
                            <span class="text-danger">{{ round(($totalTransaksiYear / $targetTransaksiTahun) * 100) }}%</span> Dari
                            {{ round($targetTransaksiTahun) }}
                        @else
                            <span class="text-primary">{{ round(($totalTransaksiYear / $targetTransaksiTahun) * 100) }}%</span> Dari
                            {{ round($targetTransaksiTahun) }}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td> <a class="text-body" href="{{ route('detailTahunNominal') }}"> @currency($NominalTransaksiYearSukses)</a></td>
                    {{--  <td>
                        @if (($NominalTransaksiYearSukses / $targetNominalTahun) * 100 < 50)
                            <span class="text-danger">{{ round(($NominalTransaksiYearSukses / $targetNominalTahun) * 100) }}%</span> Dari
                            @currency($targetNominalTahun)
                        @else
                            <span class="text-primary">{{ round(($NominalTransaksiYearSukses / $targetNominalTahun) * 100) }}%</span> Dari
                            @currency($targetNominalTahun)
                        @endif
                    </td>  --}}
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body view" id="custom">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th class="col-md-3">Pengguna </th>
                    <td><a class="text-body" href="{{ route('userAktif') }}">
                            @foreach ($userA as $item)
                                {{ $item->total }}
                            @endforeach
                        </a>/<a class="text-body" href="{{ route('detailAkunTotal') }}">{{ $user->count() }}</a>
                    </td>
                    <td>
                        {{--  @if ($targetPenggunaTahun < 50)
                            <span class="text-danger">{{round($targetPenggunaTahun)}}%</span> Dari {{$targetTahun->pengguna}}
                        @else
                            <span class="text-primary">{{round($targetPenggunaTahun)}}%</span> Dari {{$targetTahun->pengguna}}
                        @endif  --}}
                    </td>
                </tr>
                <tr>
                    <th>Pendaftaran</th>
                    <td><a class="text-body" href="{{ route('detailPendaftaranTahun') }}" id="pendaftaranUser"></a>
                    </td>
                    {{--  <td>
                        @if ($targetPendaftaranTahun < 50)
                            <span class="text-danger">{{round($targetPendaftaranTahun)}}%</span> Dari {{$targetTahun->pendaftaran}}
                        @else
                            <span class="text-primary">{{round($targetPendaftaranTahun)}}%</span> Dari {{$targetTahun->pendaftaran}}
                        @endif
                    </td>  --}}
                </tr>
                <tr>
                    <th>Transaksi</th>
                    <td><a class="text-body"
                            href="{{ route('detailTahunNominal') }}" id="totalTransaksi"></a>/<a
                            class="text-body" href="{{ route('detailTotalTahun') }}">{{ $totalTransaksiYear }}</a>
                    </td>
                    {{-- <td>
                            @if ($targetTransaksiTahun < 50)
                                <span class="text-danger">{{round($targetTransaksiTahun)}}%</span> Dari {{$targetTahun->transaksi}}
                            @else
                                <span class="text-primary">{{round($targetTransaksiTahun)}}%</span> Dari {{$targetTahun->transaksi}}
                            @endif
                        </td> --}}
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td> <a class="text-body" href="{{ route('detailTahunNominal') }}" id="nominalTransaksi"></a></td>
                    {{-- <td>
                            @if ($targetNominalTransaksiTahun < 50)
                                <span class="text-danger">{{round($targetNominalTransaksiTahun)}}%</span> Dari @currency($targetTahun->nominal)
                            @else
                                <span class="text-primary">{{round($targetNominalTransaksiTahun)}}%</span> Dari @currency($targetTahun->nominal)
                            @endif
                        </td> --}}
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
                                <tbody>
                                    @foreach ($bestProduk as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td><a href="{{ route('akun.show', $item->id_user) }}">{{ $item->nama_produk }}</a></td>
                                            <td>{{ $item->jumlah }}</td>
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
<script src="{{ asset('backend/assets/js/vendors/chart.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer="">
</script>
<script>
    $(function() {
        $('#layar').change(function() {
            $('.view').hide();
            $('#' + $(this).val()).show();
            if ($('#layar').val() == 'custom' ) {
                $('#customRange').show();
            }
        });
        $.get("{{ route('getDataTarget') }}", function(data, status) {
            $.each(data, function(key, item) {
                if (item.waktu = 'today') {
                    $('#targetToday').html()
                }
            });
        });
    });
</script>
<script>
    new Chart("Chart", {
        type: "line",

        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Oct', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendaftaran',
                tension: 0.3,
                fill: true,
                backgroundColor: 'rgba(4, 209, 130, 0.2)',
                borderColor: 'rgb(4, 209, 130)',
                data: [@php echo $chartUser @endphp]
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
<script type="text/javascript">
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange #span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $(document).ready(function () {
                dataTransaksi();
                dataPendaftaran();
                dataNominal();
            });
            function dataTransaksi(){
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('getDataTransaksiSukses') }}',
                    data: {'start': start.format('YYYY-MM-D'), 'end': end.format('YYYY-MM-D')},
                    success: function (data) {
                        $('#totalTransaksi').html(data[0]['total']);
                    }
                });
            }
            function dataPendaftaran(){
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('getDataPendaftaran') }}',
                    data: {'start': start.format('YYYY-MM-D'), 'end': end.format('YYYY-MM-D')},
                    success: function (data) {
                        $('#pendaftaranUser').html(data[0]['total']);
                    }
                });
            }
            function dataNominal(){
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('getDataNominalTransaksi') }}',
                    data: {'start': start.format('YYYY-MM-D'), 'end': end.format('YYYY-MM-D')},
                    success: function (data) {
                        $('#nominalTransaksi').text('Rp. ' + parseFloat(data[0]['total'], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                    }
                });
            }
        }

        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/^-+/, '')
                .replace(/-+$/, '')
                .replace(/\s+/g, '-')
                .replace(/\-\-+/g, '-')
                .replace(/[^\w\-]+/g, '');
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Januari': [moment().month('0').startOf('month'), moment().month('0').endOf('month')],
                'Februari': [moment().month('1').startOf('month'), moment().month('1').endOf('month')],
                'Maret': [moment().month('2').startOf('month'), moment().month('2').endOf('month')],
                'April': [moment().month('3').startOf('month'), moment().month('3').endOf('month')],
                'Mei': [moment().month('4').startOf('month'), moment().month('4').endOf('month')],
                'Juni': [moment().month('5').startOf('month'), moment().month('5').endOf('month')],
                'Juli': [moment().month('6').startOf('month'), moment().month('6').endOf('month')],
                'Agustus': [moment().month('7').startOf('month'), moment().month('7').endOf('month')],
                'September': [moment().month('8').startOf('month'), moment().month('8').endOf('month')],
                'Oktober': [moment().month('9').startOf('month'), moment().month('9').endOf('month')],
                'November': [moment().month('10').startOf('month'), moment().month('10').endOf(
                    'month')],
                'Desember': [moment().month('11').startOf('month'), moment().month('11').endOf(
                    'month')],
            }
        }, cb);

        cb(start, end);

    });
</script>
