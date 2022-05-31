<section class="content-main">
    <div class="content-header">
        <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Kembali </a>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-brand-2" style="height: 150px"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl col-lg flex-grow-0" style="flex-basis: 230px">
                    <div class="img-thumbnail shadow w-100 bg-white position-relative text-center" style="height: 190px; width: 200px; margin-top: -120px">
                        <img src="{{asset('backend/assets/imgs/people/profile.png')}}" class="center-xy img-fluid" alt="Logo Brand" />
                    </div>
                </div>
                <!--  col.// -->
                <div class="col-xl col-lg">
                    @foreach ($akun as $item )
                    <h3>{{$item->nama_toko}}</h3>
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
                        <h5 class="text-success">{{$transaksi}}</h5>
                        <p class="mb-0 text-muted">Total Penghailan:</p>
                        <h5 class="text-success mb-0">@currency($totalbayar)</h5>
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
                <!--  col.// -->
                {{--  <div class="col-sm-6 col-xl-4 text-xl-end">
                    <map class="mapbox position-relative d-inline-block">
                        <img src="{{asset('backend/assets/imgs/misc/map.jpg')}}" class="rounded2" height="120" alt="map" />
                        <span class="map-pin" style="top: 50px; left: 100px"></span>
                        <button class="btn btn-sm btn-brand position-absolute bottom-0 end-0 mb-15 mr-15 font-xs">Large</button>
                    </map>
                </div>  --}}
                <!--  col.// -->
            </div>
            <!--  row.// -->
        </div>

        <!--  card-body.// -->
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">Products by seller ({{$produk->count()}})</h3>

            <div class="row">
                @foreach($produk as $item)

                <div class="col-xl-3 col-lg-3 col-md-6">

                    <div class="card card-product-grid">

                        <a href="#" class="img-wrap"> <img src="{{asset('backend/assets/imgs/items/1.jpg')}}" alt="Product" /> </a>
                        <div class="info-wrap">
                            <a href="{{$item->link}}" target="_blank" class="title">{{$item->nama_produk}}</a>
                            <div class="price mt-1">@currency($item->harga_jual)</div>
                            <!-- price-wrap.// -->

                        </div>

                    </div>

                    <!-- card-product  end// -->
        </div>

        @endforeach

    </div>
            <!-- row.// -->
        </div>

        <!--  card-body.// -->

    </div>
</section>
