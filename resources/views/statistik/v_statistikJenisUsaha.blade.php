<h1>{{ $label }}</h1>
{{--  chart  --}}
{{--  <div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Total Jenis Usaha </h5>
                <canvas id="myChart3" height="150"></canvas>
            </article>
        </div>
    </div>
</div>  --}}
<div class="row ">
    <div class=" card card-body">
        <div class="table-responsive">
            <div class="table-responsive" >
                <table class="table align-middle table-nowrap mb-0" id="myTable"  >
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle"  style="width: 4%;" hidden>No</th>
                            <th class="align-middle"  scope="col">Nama Jenis Usaha</th>
                            <th class="align-middle"  scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataJenisUsaha as $key => $item )
                            <tr>
                                <td hidden><span> {{  ++$key }}</span></td>
                                <td class="getIdProv" data-id="{{$item->id_kategori_bisnis}}">{{$item->kategori_bisnis}}</td>
                                {{--  <td >{{$item->nama_kabupaten}}</td>  --}}
                                <td ><a onclick="fetchDataMemberViewKab('{{$item->id_kategori_bisnis}}','{{$item->id_user}}')">{{$item->total}}</a></td>
                            </tr>
                            @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <!-- table-responsive end// -->
    </div>


</div>
<div class="">
    <div  id="show" class="view card  card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table  align-middle table-nowrap mb-0" id="tableDetail">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle"  style="width: 4%;" hidden>No</th>
                            <th class="align-middle"  scope="col">Nama Toko</th>
                            <th class="align-middle"  scope="col">Alamat</Kota</th>
                            <th class="align-middle"  scope="col">No Hp</Kota</th>
                            <th class="align-middle"  scope="col">Tanggal Exp</th>
                            <th class="align-middle"  scope="col">Jumlah Transaksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataMember">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- table-responsive end// -->
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
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<script>
    $("#myTable").DataTable({
        "autoWidth": false,
        "responsive": true
    });
    $("#tableDetail").DataTable({
        "autoWidth": false,
        "responsive": true
    });
    function fetchDataMemberViewKab(id_kategori_bisnis,id_user) {
        $('#dataMember').html('');
        $.ajax({
            type: "GET",
            url: "{{ route('getDetailStatistikJenisUsaha') }}",
            data: {'id_kategori_bisnis': id_kategori_bisnis},
            dataType: "json",
            success: function (data) {
                $('#show').show();
                console.log(data);

                $.each(data, function (key, item) {
                    const settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": "https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id="+item.user_id+"&product_id="+item.produk_id,
                        "method": "GET",
                    };
                    $.ajax(settings).done(function (response) {
                    var getExp = response;
                    var getTransaksi = '';
                        $.ajax({
                            type: "GET",
                            url: "{{ route('getDataTransaksi') }}",
                            data: {'id_user': item.id_user},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (key, item) {
                                        getTransaksi = item.total;

                                });
                                $('#dataMember').append(
                                    `<tr id="teks">
                                        <td hidden><span>`+key+`</span></td>
                                        <td ><a href="{{url('akun')}}/`+item.id_user+`">`+item.nama_toko+`</a></td>
                                        <td >`+item.alamat_toko+`</td>
                                        <td >`+item.no_hp_toko+`</td>
                                        <td >`+getExp+`</td>
                                        <td >`+getTransaksi+`</td>
                                    </tr>`
                                );
                            }
                        });
                    });

                });
            }
        });

    };

</script>
