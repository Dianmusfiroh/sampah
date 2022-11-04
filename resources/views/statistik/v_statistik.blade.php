<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $label }}</h2>
    </div>
    <div>
        <div id="reportrange" class="form-control bg-white ">
            <i class="material-icons md-calendar_today"></i>&nbsp;
            <span id="span"></span> <i class="fa fa-caret-down"></i>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i
                        class="text-primary material-icons md-reorder"></i></span>
                <div class="text" >
                        <h6 class="mb-1 card-title">Pemesanan</h6>
                        <h3 id="pemesanan" ></h3>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light">
                    <i class="text-info material-icons md-send"></i></span>
                <div class="text" >
                        <h6 class="mb-1 card-title">Dikirim</h6>
                        <h3 id="dikirim"></h3>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i
                        class="text-warning material-icons md-done_all"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Selesai </h6>
                    <h3 id="selesai"></h3>
                </div>
            </article>
        </div>
    </div>
</div>
<div class="row ">
    <div class=" card card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle" style="width: 4%;">No</th>
                            <th class="align-middle" scope="col">Tanggal/Hari </th>
                            <th class="align-middle" scope="col">Pemesanan</th>
                            <th class="align-middle" scope="col">Dikirim</th>
                            <th class="align-middle" scope="col">Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
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
                            <th class="align-middle" scope="col">Nama Toko</th>
                            <th class="align-middle" scope="col">Ket</Kota< /th>
                            <th class="align-middle" scope="col">Order Id </th>
                            <th class="align-middle" scope="col">Nama Pembeli</th>
                            <th class="align-middle" scope="col">Tanggal Order</th>
                            <th class="align-middle" scope="col">Tanggal Proses</th>
                            <th class="align-middle" scope="col">Tanggal Selesai</th>
                            <th class="align-middle" scope="col">Total Bayar</th>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer="">
</script>

<script type="text/javascript">
    $(function() {
        var start = moment().subtract(6, 'days');
        var end = moment();
        function cb(start, end) {
            $('#reportrange #span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $(document).ready(function() {
                fetchData();
                fetchDataDikirim();
                fetchDataSelesai();
                if (getTable() != null) {
                    getTable().clear();
                    getTable().destroy();
                }
                $("#detail").click(function() {
                    b().show();
                });

            });
            function getTable() {
                var table = $('#myTable').DataTable({
                    "destroy": true,
                    "ajax": {
                        "type": "GET",
                        "url": "{{ route('postTable') }}",
                        "data": {
                            'start': start.format('YYYY-MM-D'),
                            'end': end.format('YYYY-MM-D')
                        },
                        "dataSrc": function(json) {
                            return json.data;
                        }
                    },
                    "columns": [{
                            "data": "DT_RowIndex",
                            "name": "DT_RowIndex"
                        }, {
                            "data": "is_created"
                        }, {
                            "name": "total"
                        }, {
                            name: 'dikirim',
                            orderable: false,
                            searchable: false,

                        }, {
                            name: 'action',
                            orderable: false,
                            searchable: false,

                        },

                    ],
                    "columnDefs": [{
                        targets: 2,
                        data: function(row, type, val, meta) {
                            return `<a onclick="getDetailPemesanan( '${row.is_created}')">${row.total} </a>`;
                        }
                    },{
                        targets: 3,
                        data: function(row, type, val, meta) {
                            return `<a onclick="getDetailDikirim( '${row.is_created}')">${row.dikirim} </a>`;
                        }
                    },{
                        targets: 4,
                        data: function(row, type, val, meta) {
                            return `<a onclick="getDetailSelesai( '${row.is_created}')">${row.action} </a>`;
                        }
                    },
                    {
                        targets: 0,
                        "visible": false
                    }]
                });
            };
            function fetchData() {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('get_Pemesanan') }}',
                    data: {
                        'start': start.format('YYYY-MM-D'),
                        'end': end.format('YYYY-MM-D')
                    },
                    success: function(data, success, html) {
                        const awal = start.format('YYYY-MM-D');
                        const akhir = end.format('YYYY-MM-D');
                        $.each(data, function(key, item) {
                            $("#pemesanan").html(`<a onclick="getDetailTotalPesanan('`+awal+`','`+akhir+`')">`+item.total+`</a>`);

                        });
                    }
                });
            }
            function fetchDataDikirim() {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('get_Dikirim') }}',
                    data: {
                        'start': start.format('YYYY-MM-D'),
                        'end': end.format('YYYY-MM-D')
                    },
                    success: function(data, success) {
                        const awal = start.format('YYYY-MM-D');
                        const akhir = end.format('YYYY-MM-D');
                        $.each(data, function(key, item) {
                            $("#dikirim").html(`<a onclick="getDetailTotalDikirim('`+awal+`','`+akhir+`')">`+item.total+`</a>`);


                        });
                    }
                });
            }
            function fetchDataSelesai() {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('get_Selesai') }}',
                    data: {
                        'start': start.format('YYYY-MM-D'),
                        'end': end.format('YYYY-MM-D')
                    },
                    success: function(data, success) {
                        const awal = start.format('YYYY-MM-D');
                        const akhir = end.format('YYYY-MM-D');

                        $.each(data, function(key, item) {
                            console.log(awal);
                            $("#selesai").html(`<a onclick="getDetailTotalSelesai('`+awal+`','`+akhir+`')">`+item.total+`</a>`);
                        });
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
                'Hari Ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],

                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')],
                'Tahun Ini': [moment().startOf('year'), moment().endOf('year')]
            }
        }, cb);
        cb(start, end);
    });
    function getDetailDikirim(is_created) {
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('getDetailDikirim') }}",
                "data": {
                    'is_created': is_created
                },
                "dataSrc": function(json) {
                    return json.data;
                    console.log(json.data);
                }
            },
            "columns": [
                {
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                }, {
                    "data": "nama_toko"
                }, {
                    "data": "ket"
                }, {
                    "data": "order_id"
                }, {
                    "data": "nama_pembeli"
                }, {
                    "data": "tgl_order"
                }, {
                    "data": "tgl_proses"
                }, {
                    "data": "tgl_selesai"
                }, {
                    "data": "totalbayar",  render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp' )
                }
            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            }, ]
        });
    };

    function getDetailSelesai(is_created) {
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('getDetailSelesai') }}",
                "data": {
                    'is_created': is_created
                },
                "dataSrc": function(json) {
                    return json.data;
                    console.log(json.data);
                }
            },
            "columns": [
                {
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                }, {
                    "data": "nama_toko"
                }, {
                    "data": "ket"
                }, {
                    "data": "order_id"
                }, {
                    "data": "nama_pembeli"
                }, {
                    "data": "tgl_order"
                }, {
                    "data": "tgl_proses"
                }, {
                    "data": "tgl_selesai"
                }, {
                    "data": "totalbayar",  render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp' )
                }
            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            }, ]
        });
    };
    function getDetailPemesanan(is_created) {
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('getDetailPemesanan') }}",
                "data": {
                    'is_created': is_created
                },
                "dataSrc": function(json) {
                    return json.data;
                    console.log(json.data);
                }
            },
            "columns": [
                {
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                }, {
                    "data": "nama_toko"
                }, {
                    "data": "ket"
                }, {
                    "data": "order_id"
                }, {
                    "data": "nama_pembeli"
                }, {
                    "data": "tgl_order"
                }, {
                    "data": "tgl_proses"
                }, {
                    "data": "tgl_selesai"
                }, {
                    "data": "totalbayar",  render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp' )
                }
            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            }, ]
        });
    };
    function getDetailTotalSelesai(awal,akhir) {
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('getDetailTotalSelesai') }}",
                "data": {
                    'start': awal,
                    'end': akhir
                },
                "dataSrc": function(json) {
                    return json.data;
                    console.log(json.data);
                }
            },
            "columns": [
                {
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                }, {
                    "data": "nama_toko"
                }, {
                    "data": "ket"
                }, {
                    "data": "order_id"
                }, {
                    "data": "nama_pembeli"
                }, {
                    "data": "tgl_order"
                }, {
                    "data": "tgl_proses"
                }, {
                    "data": "tgl_selesai"
                }, {
                    "data": "totalbayar",  render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp' )
                }
            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            }, ]
        });
    };
    function getDetailTotalDikirim(awal,akhir) {
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('getDetailTotalDikirim') }}",
                "data": {
                    'start': awal,
                    'end': akhir
                },
                "dataSrc": function(json) {
                    return json.data;
                    console.log(json.data);
                }
            },
            "columns": [
                {
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                }, {
                    "data": "nama_toko"
                }, {
                    "data": "ket"
                }, {
                    "data": "order_id"
                }, {
                    "data": "nama_pembeli"
                }, {
                    "data": "tgl_order"
                }, {
                    "data": "tgl_proses"
                }, {
                    "data": "tgl_selesai"
                }, {
                    "data": "totalbayar",  render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp' )
                }
            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            }, ]
        });
    };
    function getDetailTotalPesanan(awal,akhir) {
        $('#show').show();
        if (table != null) {
            table.clear();
            table.destroy();
        }
        var table = $('#myTable2').DataTable({
            "destroy": true,
            "ajax": {
                "type": "GET",
                "url": "{{ route('getDetailTotalPesanan') }}",
                "data": {
                    'start': awal,
                    'end': akhir
                },
                "dataSrc": function(json) {
                    return json.data;
                    console.log(json.data);
                }
            },
            "columns": [
                {
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                }, {
                    "data": "nama_toko"
                }, {
                    "data": "ket"
                }, {
                    "data": "order_id"
                }, {
                    "data": "nama_pembeli"
                }, {
                    "data": "tgl_order"
                }, {
                    "data": "tgl_proses"
                }, {
                    "data": "tgl_selesai"
                }, {
                    "data": "totalbayar",  render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp' )
                }
            ],
            "columnDefs": [{
                targets: 0,
                "visible": false
            }, ]
        });
    };


</script>
