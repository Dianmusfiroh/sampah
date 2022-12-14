
<div class="content-header">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Report</h2>

            <div class="row">
                <div  class="col-xs-3 col-md-3 " >
                    <select class="form-select form-border" id="idSelect" >
                        <option >Export</option>
                        <option  value="selesToko">Top Seles By Toko</option>
                        <option value="selesProduk">Top Seles By Produk</option>
                    </select>
                </div>
                <div class="col-xs-9 col-md-8">
                    <div id="reportrange" class="form-control  bg-white  ">
                        <i class="material-icons md-calendar_today"></i>&nbsp;
                        <span id="span"></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
              </div>
        </div>
    </div>


</div>

</div>
</div>
{{-- data picker --}}
<div class="row">
    <div class="col-lg-5">

        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">10 Top Seles By Toko</h5>
                <div class="new-member-list" id="exampleid">
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card mb-4">
            <article class="card-body">
            <h5 class="card-title">10 Top Seles By Produk</h5>
                <div class="new-member-list" id="dataTotal">

                </div>
            </article>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer="">
</script>
<script type="text/javascript">
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();
        function cb(start, end) {
            $('#reportrange #span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $(document).ready(function() {
                $("#idSelect").val("Export");

                var teks = $('#exampleid').find('#teks');
                var panjang = 11
                if (teks.length == 0) {
                    panjang = teks.length + 1
                    fetchData();
                }else if(teks.length > 0){
                    for (let index = 0; index <= panjang; index++) {
                        $("#teks").remove();
                    }
                    fetchData();
                }
                var teksDatatotal = $('#dataTotal').find('#teksDatatotal');
                if (teksDatatotal.length == 0) {
                    panjang = teksDatatotal.length + 1
                    fetchDataTotal();
                }else if(teksDatatotal.length > 0){
                    for (let index = 0; index <= panjang; index++) {
                        $("#teksDatatotal").remove();

                    }
                    fetchDataTotal();
                }

            });
            //Script select print report
            var dan = '&';
            var tgl_awal = start.format('YYYY-MM-D');
            var tgl_akhir = end.format('YYYY-MM-D');
            var e = document.getElementById("idSelect");


            //end Script print
            function fetchData() {

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('get_data') }}',
                    data: {
                        'start': start.format('YYYY-MM-D'),
                        'end': end.format('YYYY-MM-D')
                    },
                    success: function(data, success) {
                        $.each(data, function(key, item) {
                            var s =`?start=`+start.format('YYYY-MM-D')+`&end=`+end.format('YYYY-MM-D');

                            var namaToko ="";
                            if (item.nama_toko.match(/_/)) {
                                namaToko = generateSlug(item.nama_toko);
                            } else {
                                namaToko = generateSlug(item.nama_toko);
                            }

                            $('#exampleid').append(
                                `<a id="teks"href="{{ url('detailSellByToko/`+item.id_user+s+`',) }}"   class="title id_user">`+
                                `<div id="teks" class="d-flex align-items-center justify-content-between mb-3">`+
                                    `<div id="teks" class="d-flex align-items-center">`+
                                        `<img id="teks"  src="https://wbslink.id/assets/image/toko/`+item.logo_toko+`" alt="" class="avatar" />`
                                        +`<div id="teks">`+
                                            `<h6 id="teks" >`+item.nama_toko+`</h6>`
                                        +`</div>`
                                    +`</div>`
                                    +`<div id="teks" class="d-flex align-items-center">`
                                        +`<h6 id="teks" >`
                                            +item.total
                                        +`</h6>`
                                        +`<div class="px-1" id="teks">`+
                                            `<button id="teks" class=" btn  btn-primary font-sm btn-xs">Detail</button>`
                                        +`</div>`
                                    +`</div>`
                                +`</div>`
                            );
                        });
                    }
                });
                function onChange() {
                    var value = e.value;
                    if ( e.value == 'selesToko') {
                        window.open(`{{ url('storeAkun?tanggal_awal=`+tgl_awal+dan+`tanggal_akhir=`+tgl_akhir+`') }}`);
                    } else if ( e.value == 'selesProduk') {
                        window.open(`{{ url('topProdukExport?tanggal_awal=`+tgl_awal+dan+`tanggal_akhir=`+tgl_akhir+`') }}`);
                    } else {

                    }
                }
                e.onchange = onChange;
                onChange();
            }
            function fetchDataTotal() {

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('get_dataTotal') }}',
                    data: {
                        'start': start.format('YYYY-MM-D'),
                        'end': end.format('YYYY-MM-D')
                    },
                    success: function(data, success) {
                        $.each(data, function(key, item) {
                            var s =`?start=`+start.format('YYYY-MM-D')+`&end=`+end.format('YYYY-MM-D')+`&id_produk=`+item.id_produk;
                            var namaToko ="";
                            if (item.nama_toko.match(/_/)) {
                                namaToko = generateSlug(item.nama_toko);
                            } else {
                                namaToko = generateSlug(item.nama_toko);
                            }

                            $('#dataTotal').append(
                            `<a id="teksDatatotal" href="{{ url('detailSellByProduk/`+item.id_user+s+`',) }}"    class="title">`+
                            `<div id="teksDatatotal" class="d-flex align-items-center justify-content-between  mb-3">`+
                                `<div id="teksDatatotal" class="d-flex align-items-center">`+
                                    `<img id="teksDatatotal"  src="https://wbslink.id/assets/image/produk/`+item.gambar+`" alt="" class="avatar" />`

                                    +`<div id="teksDatatotal">`+
                                        `<h6 id="teksDatatotal" >`+item.nama_produk+`</h6>`
                                    +`</div>`
                                +`</div>`
                                +`<div id="teksDatatotal" class="d-flex align-items-center">`
                                    +`<h6 id="teksDatatotal">`
                                        +item.total
                                    +`</h6>`
                                    +`<div class="px-1" id="teksDatatotal">`+
                                        `<button id="teksDatatotal" class=" btn  btn-primary font-sm btn-xs">Detail</button>`
                                    +`</div>`
                                +`</div>`
                            +`</div>`
                            );
                        });
                    }
                });
            }
        }
        function generateSlug(text)
        {
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
                    'month').endOf('month')]
            }
        }, cb);
        cb(start, end);
    });


</script>
