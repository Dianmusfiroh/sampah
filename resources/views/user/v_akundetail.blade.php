<section class="content-main">
    <div class="content-header">
        <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Kembali </a>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-brand-2" style="height: 150px"></div>
        <div class="card-body">
            <div class="row">
                @foreach ($akun as $item )
                <div class="col-xl col-lg flex-grow-0" style="flex-basis: 230px">
                    <div class="img-thumbnail shadow w-100 bg-white position-relative text-center" style="height: 190px; width: 200px; margin-top: -120px">
                        {{--  <img src="{{asset('backend/assets/imgs/people/profile.png')}}" class="center-xy img-fluid" alt="Logo Brand" />  --}}
                        <img src="https://wbslink.id/assets/image/toko/{{$item->logo_toko}}" class="center-xy img-fluid" alt="Logo Brand" />
                    </div>
                </div>
                <!--  col.// -->
                <div class="col-xl col-lg">
                    <h3>{{$item->nama_toko}} <span>({{$item->username}})</span></h3>
                    <h5><span>({{$item->nama_lengkap}})</span></h5>
                    <p></p>

                    @endforeach
                </div>
                <!--  col.// -->
                {{--  <div class="col-xl-4 form-check form-switch">
                    <div class="col ">  --}}
                        {{--  @foreach ($xendit as $item)  --}}

                        {{--  {{$xendit->is_blocked}}  --}}
                        {{--  @endforeach  --}}

                        {{--  @foreach ($xendit as $item)
                        <input data-ids="{{$item->id_user}}" class="form-check-input" type="checkbox" data-onstyle="success" {{ $item->is_blocked ? 'checked' : '' }}>

                        @endforeach  --}}
                    {{--  </div>
                </div>  --}}
                <div class="col-xl-4 text-md-end">
                    @if (preg_match("/_/",$item->nama_toko))
                    <a href="https://wbslink.id/{{$item->nama_toko}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" class="btn btn-primary"> View live <i class="material-icons md-launch"></i> </a>
                    @else
                    <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" class="btn btn-primary"> View live <i class="material-icons md-launch"></i> </a>
                    @endif
                </div>
                <!--  col.// -->
            </div>
            <!-- card-body.// -->
            <hr class="my-4" />
            <div class="row g-4">
                <div class="col-md-1 col-lg-4 col-xl-3">
                    <article class="box">
                        <p class="mb-0 text-muted">Total Transaksi:</p>
                        <h5 class="text-success">{{$transaksi}}</h5>
                        <p class="mb-0 text-muted">Total Penghailan:</p>
                        <h5 class="text-success mb-0">@currency($totalbayar)</h5>
                    </article>
                </div>
                <div class="col-md-1 col-lg-4 col-xl-3">
                    <article class="box">
                        <p class="mb-0 text-muted">Tanggal Daftar:</p>
                        <h5 class="text">{{$item->is_created}}</h5>
                        <p class="mb-0 text-muted">Tanggal Expire:</p>
                        <h5>
                            @if ($exp >= $now)
                            <span class="badge rounded-pill alert-success">{{$exp}}</span>
                            @elseif(($exp >= $now) && ($exp <= $addWeek))
                            <span class="badge rounded-pill alert-warning">{{$exp}}</span>
                            @elseif($exp <= $now)
                                <span class="badge rounded-pill alert-danger">{{$exp}}</span>
                            @endif
                    </h5>

                    </article>
                </div>
                <!--  col.// -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <h6>Contacts</h6>
                    <p>
                        {{$item->nama_lengkap }} <br />
                        {{$item->email }} <br />
                        {{$item->no_hp}}
                    </p>
                </div>
                <!--  col.// -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <h6>Address</h6>
                    <p>
                        {{$item->alamat}}
                    </p>
                </div>
                <!--  col.// -->
                {{--  <div class="col-sm-6 col-xl-4 text-xl-end">
                    <map class="mapbox position-relative d-inline-block">
                        <img src="{{asset('backend/assets/imgs/misc/map.jpg')}}" class="rounded2" height="120" alt="map" />
                        <span class="map-pin" style="top: 50px; left: 100px"></span>
                        <button class="btn btn-sm btn-brand position-absolute bottom-0 end-0 mb-15 mr-15 font-xs">Large</button>
                    </map>
                </div>  --}}
                <!--  col.// -->
            </div>
            <!--  row.// -->
        </div>

        <!--  card-body.// -->
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Total Pendapatan Perbulan</h5>
                    <canvas id="myChart3" height="120px"></canvas>
                </article>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Produk Terlaris</h5>
                    <canvas id="myChartProduk" height="217"></canvas>
                </article>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <h3 class="card-title">Products by seller ({{$produk->count()}})</h3>
                </div>
            </div>
            <div class="row">
                @foreach($produk as $item)

                <div class="col-xl-2 col-lg-3 col-md-5">

                    <div class="card card-product-grid">

                        <a href="https://wbslink.id/@if (preg_match("/_/",$item->nama_toko)){{$item->nama_toko}}@else{{Str::slug($item->nama_toko)}}@endif/{{$item->id_produk}}/{{Str::slug($item->nama_produk)}}" target="_blank" class="img-wrap img-card"> <img src="https://wbslink.id/assets/image/produk/{{$item->gambar}}"  /> </a>

                        <div class="info-wrap">

                            <a href="https://wbslink.id/@if (preg_match("/_/",$item->nama_toko)){{$item->nama_toko}}@else{{Str::slug($item->nama_toko)}}@endif/{{$item->id_produk}}/{{Str::slug($item->nama_produk)}}" target="_blank" class="title" <abbr title="{{$item->nama_produk}}">
                                {{ str_limit($item->nama_produk, 14, '...') }}
                            </a>

                            <div class="price mt-1">
                                @currency($item->harga_jual)
                            </div>
                        </div>
                    </div>

                    <!-- card-product  end// -->
        </div>

        @endforeach

    </div>
            <!-- row.// -->
        </div>

        <!--  card-body.// -->

    </div>
</section>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>

<script>
    var totalpendapatan = [@php echo $totalpendapatan @endphp];
    var bulan = [@php echo $bulan @endphp];

    if ($('#myChart3').length) {
        var ctx = document.getElementById("myChart3");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: bulan,
                datasets: [ {
                        label: 'Total Pendapatan',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(44, 120, 220, 0.2)',
                        borderColor: 'rgba(44, 120, 220)',
                        data: totalpendapatan
                    }
                ]
            },
            options: {
           // indexAxis: 'y',
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
        });
    }

    var produkNama = [@php echo $produkNama @endphp];
    var produkTotal = [@php echo $produkTotal @endphp];

    console.log(bulan)
    if ($('#myChartProduk').length) {
        var ctx = document.getElementById("myChartProduk");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: produkNama,
                datasets: [{
                        label: 'Produk',
                        backgroundColor: "#5897fb",
                        barThickness: 10,
                        data: produkTotal
                    },


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
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
<script>
    $(function() {
    $('.form-check-input').change(function() {
        var is_blocked = $(this).prop('checked') == true ? 1 : 0;
        var id_user = $(this).data('ids');

        console.log(is_active)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateStatus') }}',
            data: {'is_blocked': is_blocked, 'id_user': id_user},
            success: function(data){
                console.log(is_blocked)
            }
        });
    })
    })
</script>
