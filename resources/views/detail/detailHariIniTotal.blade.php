<div class="content-header">
    <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i>Kembali </a>
</div>
<h1>{{ $label }}{{$namaHari}}</h1>

<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th>Nama Produk</th>
                        <th>QTY</th>
                        <th>Nominal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ( $totalTransaksiHariIni as $key => $item )
                        <td>{{++$key}}</td>
                        <td>{{$item->nama_toko}}</td>
                        <td>{{$item->nama_produk}}</td>
                        <td>{{$item->qty}}</td>
                        <td>@currency($item->totalbayar)</td>

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
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

