<h1>{{ $label }}</h1>
<div class="row ">
    <div class=" card card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle" style="width: 4%;">No</th>
                            <th class="align-middle" scope="col">Nama Provinsi</th>
                            <th class="align-middle" scope="col">Total</th>

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
<div class="row ">
    <div class=" view card card-body" id="show">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0" id="myTable2">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle" style="width: 4%;">No</th>
                            <th class="align-middle"  scope="col">Nama Toko</th>
                            <th class="align-middle"  scope="col">Alamat</Kota</th>
                            <th class="align-middle"  scope="col">No Hp</Kota</th>
                            <th class="align-middle"  scope="col">Tanggal Exp</th>
                            <th class="align-middle"  scope="col">Jumlah Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
{{--  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<script>
    $(function() {

        const get_expire = async (user_id, product_id) => {
            let obj;
            const res = await fetch(
                `{{ getenv('WBS_ENPOINT') }}?_key={{ getenv('WBS_KEY') }}&user_id=${user_id}&product_id=${product_id}`
            );
            obj = await res.text();

            console.log(obj)
            return obj
        }

        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getStudents') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_provinsi',
                    name: 'nama_provinsi'
                },
                {
                    name: 'jumlah'
                },
            ],
            columnDefs: [{
                targets: 2,
                data: function(row, type, val, meta) {
                    return `<a onclick="fetchDataMemberViewKab('${row.prov}')">${row.jumlah}</a>`

                    {{--  fetchDataMemberViewKab(idProv)  --}}

                }
            }, ]
        });
    });

    function fetchDataMemberViewKab(idProv) {
        console.log(idProv);
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('memberViewKab') }}",
                "data": {
                    'idProv': idProv
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
                    "data": "alamat_toko"
                },
                {
                    "data": "no_hp_toko"
                },
                {
                    data: 'getExp',
                    name: 'getExp',
                    orderable: false,
                    searchable: false,
                },
                {
                    name: 'getDataTransaksi',
                    orderable: false,
                    searchable: false,
                },

            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            },
            {
                targets: 5,
                className: 'dt-body-center',
                data: function( row, type, val, meta){
                    return `<a href="{{url('getDetailTransaksiUser')}}/${row.id_user}">${row.getDataTransaksi}</a>`
                }
            },

           ]
        });
    };
</script>
