<div class="content-header">
    <div>
        <h2 class="content-title card-title">Report</h2>
        <p>Whole data about your business here</p>
    </div>

    </div>
</div>
{{--  data picker  --}}
<div class="row">
    <div class="col-lg-5">
        <div class="card mb-4">
            <article class="card-body">
                <div class="new-member-list" id="pToko">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control" name="daterange" value="{{$now->firstOfMonth()->format('m/d/Y')}} - {{$now->lastOfMonth()->format('m/d/Y')}}" />
                            <div>
                                <button type="submit" class=" ml-10 btn btn-primary" id="btnSearch">cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">

        <div class="card mb-4">
            <article class="card-body">


                <h5 class="card-title">Top Seles By Toko</h5>
                <div class="new-member-list" id="pToko">
                    @foreach ($penjualanToko as $item )
                    @if (preg_match("/_/",$item->nama_toko))
                    <a id="data"  href="https://wbslink.id/{{$item->nama_toko}}" target="_blank"  >
                    @else
                    <a id="data"  href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank"  ></i>
                    @endif
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center">
                            <img id="data"  src="https://wbslink.id/assets/image/toko/{{$item->logo_toko}}" alt="" class="avatar" />
                            <div>
                                <h6 id="data" >{{$item->nama_toko}}</h6>
                            </div>
                        </div>
                        <div id="data" >{{$item->total}}</div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Top Seles By Produk</h5>
                <div class="new-member-list">
                    @foreach ($produk as $item )
                    @if (preg_match("/_/",$item->nama_toko))
                    <a id="data" href="https://wbslink.id/{{$item->nama_toko}}/{{$item->id_produk}}/{{Str::slug($item->nama_produk)}}" target="_blank" class="title">
                    @else
                    <a id="data" href="https://wbslink.id/{{Str::slug($item->nama_toko)}}/{{$item->id_produk}}/{{Str::slug($item->nama_produk)}}" target="_blank" class="title">
                    @endif
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center">
                            <img id="data" src="https://wbslink.id/assets/image/produk/{{$item->gambar}}" alt="" class="avatar" />
                            <div>
                                <h6 id="data">{{$item->nama_produk}}</h6>
                            </div>
                        </div>
                        <div id="data">{{$item->total}}</div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </article>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


{{--  Script yang Jadi  --}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.noConflict();
        jQuery(document).ready(function($){
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'

        }, function(start, end, label) {
            $("#btnSearch").on("click",function(){
                var tanggal_awal = start.format('YYYY-MM-DD');
                var tanggal_akhir = end.format('YYYY-MM-DD');
                console.log(tanggal_awal);

                window.location ="http://localhost/panel_wbslink/public/report?tanggal_awal="+tanggal_awal+"&tanggal_akhir="+tanggal_akhir+"";

            });
        });
    });
</script>
{{--  $.each(data.penjualanToko, function(){
    $('#data').append('<img id="data" src="https://wbslink.id/assets/image/produk/'+ this['logo_toko']+ '" alt="" class="avatar" />');

});  --}}
