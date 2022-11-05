<div class="content-header">
    <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i>Kembali </a>
</div>
<h1>{{ $label }}  </h1>
<div class="card mb-4">
    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th hidden>No</th>
                        <th>Nama Toko</th>
                        <th>Ket</th>
                        <th>Order Id</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal Order</th>
                        <th>Tanggal Dikirim</th>
                        <th>Tanggal Selesai</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailTransaksi as $key => $item )
                    <tr>
                        <td hidden>{{++$key}}</td>
                        <td>{{$item->nama_toko}}</td>
                        <td>{{$item->ket}}</td>
                        <td>{{$item->order_id}}</td>
                        <td>{{$item->nama_pembeli}}</td>
                        <td>{{$item->tgl_order}}</td>
                        <td>{{$item->tgl_proses}}</td>
                        <td>{{$item->tgl_selesai}}</td>
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
{{--  @include('script.delete')  --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>

<script>
    $("#myTable").DataTable({
        "autoWidth": false,
        "responsive": true,
        "order": [5,'desc']
    });
</script>

