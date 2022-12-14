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
                        <h5 class="text-success"><a href="{{url('getDetailTransaksiUser')}}/{{$item->id_user}}">{{$transaksi}}</a></h5>
                        <p class="mb-0 text-muted">Total Penghailan:</p>
                        <h5 class="text-success mb-0"><a href="{{url('getDetailTransaksiUser')}}/{{$item->id_user}}">@currency($totalbayar)</a></h5>
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
            </div>
            <!--  row.// -->
        </div>

        <!--  card-body.// -->
    </div>
    {{--  pengaturan Akun Xendit  --}}
    <div class="card mb-4">
        <article class="card-body ">
            @if ($xendit !='')
            <h5 class="card-title">Pengaturan Xendit</h5>
            <div class="row ">
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <h6>Email</h6>
                    <p>
                        {{$xendit ? $xendit->email : 'Belum ada akun xendit'}} <br />
                    </p>
                </div>
                <div class="col-sm-9 col-lg-4 col-xl-2">
                    <h6>Nama Bisnis</h6>
                    <p>
                        {{$xendit ? $xendit->business_name : 'Belum ada akun xendit'}} <br />
                    </p>
                </div>

                <div class="col-sm-12 col-lg-4 col-xl-2">
                    <h6>Blokir Xendit</h6>
                    <p>
                        <div class="row align-items-start form-check form-switch">
                            {{--  <input type="checkbox" data-width="100" checked data-toggle="toggle" class="form-check-input" data-onstyle="outline-wbslink" data-offstyle="outline-wbslink" data-ids="{{$xendit ? $xendit->id_user : ''}}"  {{ ($xendit ? $xendit->is_blocked : '') ? 'checked' : '' }} data-checked="On" data-unchecked="Off">  --}}
                            <input type="checkbox" data-width="100"  data-toggle="toggle"    data-ids="{{$xendit ? $xendit->id_user : ''}}" class="form-check-input "  data-onstyle="outline-wbslink" data-offstyle="outline-wbslink" {{ ($xendit ? $xendit->is_blocked : '') ? 'checked' : '' }} data-checked="On" data-unchecked="Off">
                        </div>
                    </p>



                </div>
                <div class="col-sm-9 col-lg-4 col-xl-2">
                    <h6>Reset Pin</h6>
                    <p >
                        <div class="col">
                            <a data-toggle="modal" data-target="#myModal" id="reset" class="btn btn-primary">Reset</a>
                        </div>
                    </p>
                </div>
                <div class="col-sm-9 col-lg-4 col-xl-3">
                    <h6>Log</h6>
                    <p >
                        <div class="col">
                            <a data-toggle="modal" data-target="#modalLog" id="withdraw"class="btn btn-primary">Log Withdraw</a>
                        </div>
                    </p>

                </div>

            </div>
            @else
            <h1 class="text-md-center">Belum Ada Akun Xendit</h1>
            @endif
        </article>
    </div>
    {{--  pengaturan setting Custom  --}}
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <h5>Setting Custom</h5>
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <div class="col">
                        <a data-toggle="modal" data-target="#modalCustom" id="tambahCustom"class="btn btn-primary">Tambah</a>
                    </div>
                </div>
            </div>
        </header>
        <article class="card-body ">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Fitur</th>
                        <th class="text-md-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($settingCustom as $key => $item)
                    @if ($item->kd_fittur != '')
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->fittur}}</td>
                            <td class="text-md-center">
                                <div class="row align-items-start form-check form-switch">
                                    <div class="col ">
                                    <input type="checkbox" data-width="60" data-size="sm" data-toggle="toggle"    data-ids="{{$item ? $item->kd_fittur : ''}}" class="custom-control-input "  data-onstyle="outline-wbslink" data-offstyle="outline-wbslink" {{ ($item ? $item->status : '') ? 'checked' : '' }} data-checked="On" data-unchecked="Off">
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->kd_fittur}})"
                                        data-target="#DeleteModal" class="material-icons md-delete_outline">
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @else($item->kd_fittur == '')
                        <h1>tidak ada</h1>
                        @endif
                        @endforeach
                </tbody>
            </table>
            </div>
        </article>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Statistik</h5>
                <div class="row gx-4">
                    <aside  class="col-lg-2 border-end">
                        <nav  id="layar" class="nav nav-pills flex-column mb-4">
                            <a  class="nav-link active" aria-current="page" value="perbulan">Pendapatan Perbulan</a>
                            <a   class="nav-link"  value="produk" >Produk Terlaris</a>
                        </nav>
                    </aside>
                    <div class="col-lg-10">
                        <section class="content-body p-xl-12 view"  style="display: block;"  id="perbulan">
                            <canvas  id="myChart3" height="120px"></canvas>
                        </section>
                        <section class="content-body p-xl-12 view"  id="produk">
                            <canvas  id="myChartProduk" height="120px"></canvas>
                        </section>
                        <!-- content-body .// -->
                    </div>
                    <!-- col.// -->
                </div>
                <!-- row.// -->
            </div>
            <!-- card body end// -->
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
    </div>
    </div>
    <!-- Modal -->
{{--  modal Reset Pin  --}}
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Konfirmasi Reset Pin Xendit</h4>
                <button type="button" class="btn-close " data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('resetPin.update',$item->id_user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4 text-center">
                        <h6>Apakah Anda Yakin Ingin Reset Pin Xendit?</h6>
                    </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary " value="{{$xendit ? $xendit->pin : ''}}" type="submit">Ya, Reset</button>
            </form>

            </div>
        </div>
    </div>
</div>
{{--  modal Log Xendit  --}}
<div class="modal fade" id="modalLog" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>log Withdraw akun Xendit Toko {{$item->nama_toko}}</h4>
                <button type="button" class="btn-close " data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{--  <form action="{{ route($modul.'.store') }}" method="POST">
                    @csrf  --}}
                    <div class="row mb-4 text-center">
                        <h6>Isi Log Comming Soon...</h6>
                    </div>
            </div>
            {{--  <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary " type="submit">Ya, Reset</button>
            </form>
            </div>  --}}
        </div>
    </div>
</div>
{{--  modal tambah setting custom  --}}
<div class="modal fade" id="modalCustom" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tambah Setting Custom</h4>
                <button type="button" class="btn-close " data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('settingCustom.store') }}" method="POST">
                    @csrf
                    <input type="text" name="id_user" hidden value="{{$item->id_user}}">

                    <div class="row mb-4">
                        <label class="col-lg-3 col-form-label">Nama Fitur</label>
                        <div class="col-lg-9">

                            <select name="id_fittur" id="fitur" class="form-control">
                                @foreach ($fittur as $item)
                                <option value="{{$item->id_fittur}}">{{$item->fittur}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary " type="submit">Simpan</button>
            </form>

            </div>
        </div>
    </div>
</div>
</section>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
{{--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
@include('script.deleteAkunDetail')

<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>
</script>
</script>
<script>

    $(function() {
        $("#layar").on("click","a", function(){
            $('.view').hide();
            $('#'+$(this).attr('value')).show();
        });
    });
</script>
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
    const pNama = produkNama.map(label => label.split(' '));
    console.log(pNama);
    console.log(bulan)
    if ($('#myChartProduk').length) {
        var ctx = document.getElementById("myChartProduk");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: pNama,
                datasets: [{
                        label: 'Produk',
                        backgroundColor: "#5897fb",
                        barThickness: 25,
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
                    x:{
                        ticks:{
                            font:{
                                size:9
                            }
                        }
                    },
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
        console.log(is_blocked)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateStatus') }}',
            data: {'is_blocked': is_blocked, 'id_user': id_user},
            success: function(data){
                console.log(is_blocked)
            }
        });
    });
    });
    $( document ).ready(function() {
        $('.custom-control-input').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var kd_fittur = $(this).data('ids');

            console.log(status)
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('updateStatusCustom') }}',
                data: {'status': status, 'kd_fittur': kd_fittur},
                success: function(data,success){
                    console.log(data);
                }
            });
        });
    });
</script>

