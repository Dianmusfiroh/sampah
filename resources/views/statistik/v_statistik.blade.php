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
                <div class="text" href="{{ url('akun') }}">
                    <a href="{{ url('akun') }}">
                        <h6 class="mb-1 card-title">Pemesanan</h6>
                        <h3 id="pemesanan"></h3>
                    </a>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light">
                    <i class="text-info material-icons md-send"></i></span>
                <div class="text" href="{{ url('userAktif') }}">
                    <a href="{{ url('userAktif') }}">
                        <h6 class="mb-1 card-title">Dikirim</h6>
                        <h3 id="dikirim"></h3>
                    </a>
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
                    <h3 id="selesai"> </h3>
                    {{-- <span> {{$userToDay}}</span> --}}

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
                    "columns": [

                        {
                            "data": "DT_RowIndex",
                            "name": "DT_RowIndex"
                        },
                        {
                            "data": "is_created"
                        },
                        {
                            "data": "total"
                        },
                        {
                            data: 'dikirim',
                            name: 'dikirim',
                            orderable: false,
                            searchable: false,
                                
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,

                        },

                    ],
                    "columnDefs": [{
                        targets: 0,
                        "visible": false
                    }, ]
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
                        $.each(data, function(key, item) {
                            $("#pemesanan").text(item.total);
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
                        $.each(data, function(key, item) {
                            $("#dikirim").text(item.total);

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

                        $.each(data, function(key, item) {
                            $("#selesai").text(item.total);
                        });
                    }
                });
            }



            {{-- $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    console.log(startDate);
                    let date = startDate + '&' + endDate;
                    $(this).attr('date', date);
                    let today = moment().format('YYYY-MM-DD');
                    let dateDiff = moment(today).diff(moment(startDate), 'days');
                    if (dateDiff < 6) {
                        dataEndpoint = "weekRange.php?" + date;
                        title = "Week View";
                    } else {
                        dataEndpoint = "monthRange.php?" + date;
                        title = "Month View";
                    }

                    // assign a reference to the chart in the dom
                    let chartRef = document.getElementById("chart-id-goes-here").getContext('2d');

                    $.ajax({
                        url: dataEndpoint,
                        dataType: 'json',
                        success: function (graphData) {
                            new Chart(chartRef, {
                                type: 'bar',
                                data: {
                                    labels: Object.keys(graphData),
                                    datasets: [{
                                        label: title,
                                        data: Object.values(graphData),
                                    }] //end datasets
                                }, //end data
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        }
                    })
                }); --}}

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
</script>
