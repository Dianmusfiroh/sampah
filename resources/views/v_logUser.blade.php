<h1>{{ $label }}</h1>

<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle"  style="width: 4%;" hidden>No</th>
                            <th class="align-middle"  scope="col">Nama Toko</th>
                            <th class="align-middle"  scope="col">Nama Lengkap</th>
                            <th class="align-middle"  scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($log as $key => $item )
                            <tr>
                                <td hidden><span> {{  ++$key }}</span></td>
                                <td >
                                    <a href="{{ route( 'akun.show', $item->id_user) }}">
                                            <h6 class="mb-0 title">{{ $item->nama_toko }}</h6>
                                    </a>
                                </td>
                                <td ><a href="{{ route( 'akun.show', $item->id_user) }}">
                                    <h6>{{ $item->nama_lengkap }}</h6></a></td>
                                <td class="mb-0 title">Melakukan <b>{{ $item->aksi }}</b> Transaksi <b>@php $pesanan= json_decode($item->pesanan,true); echo $pesanan[0]['order_id'];  @endphp</b></td>

                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table-responsive end// -->
    </div>
    {{--  <div class="card-body">
        <div class="table-responsive">
            <table  class="table align-middle table-nowrap mb-0" id="myTable">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Toko</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($log as $key => $item )
                        <tr>
                            <td >
                                <span> {{  ++$key }}</span>
                            </td>

                            <td >
                                <a href="{{ route( 'akun.show', $item->id_user) }}">
                                    <div class="left">
                                    </div>
                                    <div class="info pl-3">
                                        <h6 class="mb-0 title">{{ $item->nama_toko }}</h6>
                                    </div>
                                </a>
                            </td>
                            <td >
                                <a href="{{ route( 'akun.show', $item->id_user) }}">
                                    <h6>{{ $item->nama_lengkap }}</h6></a></td>
                            <td class="mb-0 title">Melakukan <b>{{ $item->aksi }}</b> Transaksi <b>{{ $logPensanan[0]['order_id'] }}</b></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <!-- table-responsive.// -->
    </div>  --}}
    </div>
</div>
<!-- card-body end// -->
</div>
@include('script.delete')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
    $(function() {
    $('.form-check-input').change(function() {
        var is_active = $(this).prop('checked') == true ? 1 : 0;
        var id_user = $(this).data('ids');

        console.log(is_active)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateStatus') }}',
            data: {'is_active': is_active, 'id_user': id_user},
            success: function(data){
                console.log(url)
            }
        });
    })
    })
</script>
//script is_active
{{--  <script>
    $(function() {
    $('.form-check-input').change(function() {
        var is_active = $(this).prop('checked') == true ? 1 : 0;
        var id_user = $(this).data('ids');

        console.log(is_active)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateStatus') }}',
            data: {'is_active': is_active, 'id_user': id_user},
            success: function(data){
                console.log(url)
            }
        });
    })
    })
</script>  --}}
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

