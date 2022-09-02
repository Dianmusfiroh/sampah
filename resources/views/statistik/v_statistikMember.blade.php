<h1>{{ $label }}</h1>
<div class="row ">
    <div class=" card card-body">
        <div class="table-responsive">
            <div class="table-responsive" >
                <table class="table align-middle table-nowrap mb-0" id="myTable"  >
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle"  style="width: 4%;" >No</th>
                            <th class="align-middle"  scope="col">Nama Provinsi</th>
                            <th class="align-middle"  scope="col">Total</th>

                        </tr>
                    </thead>
                    <tbody>
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
                <table class="table  align-middle table-nowrap mb-0" id="myTable2">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle"  style="width: 4%;" hidden>No</th>
                            <th class="align-middle"  scope="col">Nama Toko</th>
                            <th class="align-middle"  scope="col">Alamat</Kota</th>
                            <th class="align-middle"  scope="col">Kabupaten</Kota</th>
                            <th class="align-middle"  scope="col">No Hp</Kota</th>
                            <th class="align-middle"  scope="col">Tanggal Exp</th>
                            <th class="align-middle"  scope="col">Jumlah Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="dataMember">
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table-responsive end// -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<script>
   $(function () {
        const get_expire = async (user_id,product_id) =>{
            let obj;
            const res =  await fetch (`{{getenv('WBS_ENPOINT')}}?_key={{getenv('WBS_KEY')}}&user_id=${user_id}&product_id=${product_id}`);
            obj = await res.text();

            console.log(obj)
            return obj
        }
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getStudents') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_provinsi', name: 'nama_provinsi'},
                {name: 'jumlah'},
            ],
            columnDefs: [
                {
                    targets: 2,
                    data: function( row, type, val, meta){
                        return `<a onclick="fetchDataMemberViewKab('${row.prov}')">${row.jumlah}</a>`
                        fetchDataMemberViewKab(idProv)
                    }
                },
            ]
        });
    });
    function fetchDataMemberViewKab(idProv) {
        $('.dataMember').html('');
        $.ajax({
            type: "GET",
            url: "{{ route('memberViewKab') }}",
            data: {'idProv': idProv},
            dataType: "json",
            success: function (data) {
                $('#show').show();
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
                                $('.dataMember').append(
                                    `<tr id="teks">
                                        <td hidden><span>`+key+`</span></td>
                                        <td ><a href="{{url('akun')}}/`+item.id_user+`">`+item.nama_toko+`</a></td>
                                        <td >`+item.alamat_toko+`</td>
                                        <td >`+item.nama_kabupaten+`</td>
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
