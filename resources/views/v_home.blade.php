<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $label }}</h2>
        <p>Whole data about your business here</p>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i
                        class="text-primary material-icons md-supervised_user_circle"></i></span>
                <div class="text" href="{{ url('akun') }}">
                    <a href="{{ url('akun') }}" >
                    <h6 class="mb-1 card-title">User</h6>
                    {{--  <h3>{{ $exp }}</h3>  --}}
                    <h3>{{ $user->count() }}</h3>
                    <span class="text-sm"> Total Jumlah User   </span></a>
                </div>
            </article>
        </div>
    </div>
     <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-verified_user"></i></span>
                <div class="text"  href="{{ url('userAktif') }}">
                    <a href="{{ url('userAktif') }}" >
                    <h6 class="mb-1 card-title">User Aktif</h6>
                    <h3>@foreach ($userA as $item )
                        {{ $item->total}}
                    @endforeach</h3>
                    <span class="text-sm"> jumlah User Aktif  </span></a>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i
                        class="text-warning material-icons md-qr_code"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Pendaftaran </h6>
                    <span> {{$userToDay}}</span>

                    <span class="text-sm"> User Terdaftar Hari Ini </span>
                </div>
            </article>
        </div>
    </div>
    {{--  <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i
                        class="text-warning material-icons md-qr_code"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">User Expired</h6>
                    <span> {{$userExpToDay}}</span>

                    <span class="text-sm"> User Expired Hari Ini </span>
                </div>
            </article>
        </div>
    </div>  --}}

    <div class="col-lg-3">
        <div class="card card-body mb-5">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-success-light"><i
                        class="text-success material-icons md-local_shipping"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Transaksi</h6>
                    <span>{{$totalTransaksi}}</span>
                    <span class="text-sm"> Jumlah Order  </span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-success-light"><i
                        class="text-success material-icons md-local_shipping"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Transaksi Selesai</h6>
                    <span>{{$totalTransaksiSelesai}}</span>
                    <span class="text-sm"> Jumlah Order  </span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3 ">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-success-light"><i
                        class="text-success material-icons md-local_shipping"></i></span>
                <div class="text">
                    <h5 class="mb-1 card-title">Nominal Transaksi</h5>
                    <h4>@currency($totalTransaksiRP)</h4>
                    {{--  <span class="text-sm"> Jumlah Order  </span>  --}}
                </div>
            </article>
    </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i
                        class="text-warning material-icons md-qr_code"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Products</h6>
                    <span>{{ $produk->count() }}</span>

                    <span class="text-sm"> Jumlah Produk </span>
                </div>
            </article>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Sale statistics</h5>
                    <canvas id="Chart" height="120px"></canvas>
                </article>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Produk Terbaik Bulan Ini</h5>
                        <div class="new-member-list">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach($bestSeller as $key => $item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td><a href="{{ route( 'akun.show', $item->id_user) }}">{{$item->nama_produk}}</a></td>
                                                <td>{{$item->jumlah}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Expired</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th width="12%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{--  @dump($now->addMonth())  --}}
                    @foreach ($akunA as $key => $item   )
                        <tr>
                            <td>
                                <span> {{  ++$key }}</span>
                            </td>

                            <td width="20%">
                                <a href="{{ route( 'akun.show', $item->id_user) }}">
                                {{--  <a href="http://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" class="itemside">  --}}
                                    <div class="left">
                                    </div>
                                    <div class="info pl-3">
                                        <h6 class="mb-0 title">{{ $item->nama_toko }}</h6>
                                    </div>
                                </a>
                            </td>
                            <td>{{$item->nama_lengkap}}</td>
                            {{--  {{$item->tgl_expired}}  --}}
                            <td>
                                <a href="{{ route( 'akun.show', $item->id_user) }}">

                                    <span class="badge rounded-pill alert-warning">{{$item->tgl_expired}}</span>
                                </a>
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td class="text-center">

                                {{--  <a href="" id="btnDetail" class="btn btn-sm btn-blue "> Detail </a>  --}}
                                {{--  <a href="http://api.whatsapp.com/send?phone=62{{ $item->no_hp }}&text=Hallo {{ $item->nama_toko }}%20Owner%20Dari%20Booth%20{{ $item->nama_lengkap }}%20Berikut%20Tagihan%20pembayaran%20BPOS%20Anda%20Untuk%20Bulan%20{{$strBulan}}-{{$item->tahun}}%20Sebesar%20Rp.%20{{$item->jumlah_bayar}}%0A%0ASilahkan%20Lakukan%20Pembayaran%20Ke%20Rekening%20Berikut:%0A@foreach($adminBank as $admin){{$admin->nama_bank}}%20{{$admin->no_rekening}}%0A @endforeach%0A%0A%0Aa.n%20klikdigital%20indonesia%0A%0AUntuk%20Bukti%20Transaksi%20Bisa%20Dilihat%20Di%20Link%20Berikut%0A{{ route( $model.'.downloadPdf', $item->id_biodata) }}"
                                target="_blank"  class="btn btn-sm btn-md">Send  --}}

                            <a href="http://api.whatsapp.com/send?phone=62{{ $item->no_hp }}&text=Hallo%20{{$item->nama_lengkap}}%20Akun%20WBS-Link%20anda%20Akan%20segera%20habis%20masa%20berlakunya" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}"  ><i class=" material-icons md-send"></i></a>
                            </td>
                            @endforeach

                        </tr>
                </tbody>
            </table>
        </div>
        <!-- table-responsive.// -->
    </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>

<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>
<script>
var userExp = [@php echo $chart @endphp];
var userActive = [@php echo $chartUser @endphp];
console.log(userActive);
new Chart("Chart", {
    type: "line",

    data: {
    labels: ['Jan', 'Feb', 'Mar','Apr','Mei','Jun','Jul','Ags','Sep','Oct','Nov','Des'],
    datasets: [{
        label: 'User Expired',
        tension: 0.3,
        fill: false,
        backgroundColor: 'rgba(255, 0, 0, 0.85)',
        borderColor: 'rgba(255, 0, 0, 0.85)',
        data: userExp
    },
    {
        label: 'User Aktif',
        tension: 0.3,
        fill: false,
        backgroundColor: 'rgba(4, 209, 130, 0.2)',
        borderColor: 'rgb(4, 209, 130)',
        data: userActive
    }]
    },
        options: {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                    },
                }
            }
        }
});
</script>




