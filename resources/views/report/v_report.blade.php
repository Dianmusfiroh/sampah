<div class="content-header">
    <div>
        <h2 class="content-title card-title">Report</h2>
        <p>Whole data about your business here</p>
    </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Top Seles By Toko</h5>
                <div class="new-member-list">
                    @foreach ($penjualanToko as $item )
                    @if (preg_match("/_/",$item->nama_toko))
                    <a href="https://wbslink.id/{{$item->nama_toko}}" target="_blank"  >
                    @else
                    <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank"  ></i>
                    @endif
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center">
                            <img src="https://wbslink.id/assets/image/toko/{{$item->logo_toko}}" alt="" class="avatar" />
                            <div>
                                <h6>{{$item->nama_toko}}</h6>
                            </div>
                        </div>
                        <div >{{$item->total}}</div>
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
                    <a href="https://wbslink.id/{{$item->nama_toko}}/{{$item->id_produk}}/{{Str::slug($item->nama_produk)}}" target="_blank" class="title">
                    @else
                    <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}/{{$item->id_produk}}/{{Str::slug($item->nama_produk)}}" target="_blank" class="title">
                    @endif
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center">
                            <img src="https://wbslink.id/assets/image/produk/{{$item->gambar}}" alt="" class="avatar" />
                            <div>
                                <h6>{{$item->nama_produk}}</h6>
                            </div>
                        </div>
                        <div >{{$item->total}}</div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </article>
        </div>
    </div>
</div>
