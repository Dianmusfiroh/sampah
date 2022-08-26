<div class="content-header">
    <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i>Kembali </a>
</div>
<h3>{{ $label }}{{$namaToko->nama_toko}}</h3>

<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Usaha</th>
                        <th>Nama produk</th>
                        <th>Nama Konsumen</th>
                        <th>Tanggal Order</th>
                        <th>Tanggal Dikirim</th>
                        <th>Tanggal Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ( $detail as $key => $item )
                        <td >{{++$key}}</td>
                        <td>
                    <a href="{{ url('akun', $item->id_user ) }}">
                        {{$item->nama_lengkap}}</td>
                        <td>
                            <a href="{{ url('akun', $item->id_user ) }}">{{$item->nama_toko}}</td>
                        <td>{{$item->nama_produk}}</td>
                        <td>{{$item->nama_pembeli}}</td>
                        <td>{{$item->tgl_order}}</td>
                        <td>{{$item->tgl_kirim}}</td>
                        <td>{{$item->tgl_selesai}}</td>
                    </a>


                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- table-responsive.// -->
    </div>
    </div>
</div>
<!-- card-body end// -->
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

