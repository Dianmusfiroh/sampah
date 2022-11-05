<h1>{{ $label }}</h1>
<div class="row ">
    <div class=" card card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th hidden class="align-middle"  style="width: 4%;">No</th>
                            <th class="align-middle" scope="col">Nama Pengiriman</th>
                            <th class="align-middle" scope="col">Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penggiriman as $key => $item )
                        <tr>
                            <td hidden><span> {{  ++$key }}</span></td>
                            <td  >{{$item->expedisi}}</td>
                            <td > <a  onclick="fetchDataTransaksi('{{$item->expedisi}}')">{{$item->total}}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table-responsive end// -->
    </div>
</div>
<div class="row ">
    <div class=" view card card-body" id="show">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0" id="myTable2">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle" style="width: 4%;">No</th>
                            <th class="align-middle"  scope="col">Nama Toko</th>
                            <th class="align-middle"  scope="col">ket</th>
                            <th class="align-middle"  scope="col">Order Id</Kota</th>
                            <th class="align-middle"  scope="col">Nama Pembeli</Kota</th>
                            <th class="align-middle"  scope="col">Tanggal Order</th>
                            <th class="align-middle"  scope="col">Tanggal Proses</th>
                            <th class="align-middle"  scope="col">Tanggal Selesai</th>
                            <th class="align-middle"  scope="col">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
    $("#myTable").DataTable({
        "autoWidth": false,
        "responsive": true,
        "order": [[ 2, 'desc' ]],

    });
</script>
<script>
    function fetchDataTransaksi(expedisi) {
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('getDetailStatistikPengirim') }}",
                "data": {
                    'expedisi': expedisi
                },
                "dataSrc": function(json) {
                    return json.data;
                }
            },
            "columns": [

                {
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                },
                {
                    "data": "nama_toko"
                },
                {
                    "data": "ket"
                },
                {
                    "data": "order_id"
                },   {
                    "data": "nama_pembeli"
                },   {
                    "data": "tgl_order"
                },   {
                    "data": "tgl_proses"
                },   {
                    "data": "tgl_selesai"
                },  {
                    "data": "totalbayar",  render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp' )
                },

            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            },
           ],
            "order": [[ 5, 'desc' ]],

        });
    };

</script>
