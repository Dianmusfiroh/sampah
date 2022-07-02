<h1>{{ $label }}</h1>

<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Toko</th>
                        <th  width="50%">Nama Lengkap</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        {{--  <th>Total Transaksi</th>  --}}
                        <th width="20%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
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
                            <td >
                                <a href="{{ route( 'akun.show', $item->id_user) }}">
                                    <h6>{{ $item->nama_lengkap }}</h6></a></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_hp }}</td>
                            {{--  <td></td>  --}}
                            <td class="text-end">
                                <div class="row align-items-start form-check form-switch">
                                    <div class="col ">

                                        <input data-ids="{{$item->id_user}}" class="form-check-input" type="checkbox" data-onstyle="success" {{ $item->is_active ? 'checked' : '' }}>
                                        {{--  <span class="badge badge-pill badge-soft-success dataExp btn btn-blue" id="demo">Paid</span>  --}}
                                        {{--  <button data-uid="{{$item->user_id}}" data-pid="{{$item->produk_id}}" id="dataExp">Click me</button>  --}}
                                        {{--  <input data-ids="{{$item->id_user}}" data-uid="{{$item->user_id}}" data-pid="{{$item->produk_id}}" class="badge badge-pill badge-soft-success dataExp btn btn-blue"  onclick="myFunction()"></button>  --}}
                                        @if (preg_match("/_/",$item->nama_toko))
                                        <a href="https://wbslink.id/{{$item->nama_toko}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>
                                        @else
                                        <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>
                                        @endif
                                        {{--  <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>  --}}
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id_user}})"
                                            data-target="#DeleteModal" class="material-icons md-delete_outline">
                                            </a>
                                    </div>
                                </div>
                            </td>
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
@include('script.delete')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
{{--  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>  --}}
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>
<script>
    function changeValue(id){
        document.getElementById('dataExp').attr('data-uid') = console.log(attr('data-uid'));
        document.getElementById('demo').value = attr('data-uid');
        };
    {{--  $('#dataExp').on('click', function (e) {
        e.preventDefault();
        let $this = $(this);
        let id = $this.attr('data-uid');
        document.getElementById("demo").innerHTML = id;

     });  --}}
    {{--  fetch('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id=30856&product_id=175')
    .then(response => response.text())
    .then(data => console.log(data));
    var user = $(this).data('uid');
    console.log(user)
    function myFunction() {
        document.getElementById("demo").innerHTML = "user_id";
    }  --}}
    {{--  .catch(error => {
    alert('error');
    });  --}}
    {{--  $(function() {
    $('#dataExp').change(function() {

        var id_user = $(this).data('ids');
        var user_id = $(this).data('uid');
        console.log(user_id);
        console.log(is_active)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateStatus') }}',
            data: {'is_active': is_active, 'id_user': id_user},
            success: function(data){
                console.log(id_user)
            }
        });
    })
    })  --}}
</script>
//script is_active
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
                console.log(is_active)
            }
        });
    })
    })
</script>



