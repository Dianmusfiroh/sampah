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
                    {{--  <span id="tes">
                        @foreach ($json as $item )
                            {{$item->user_id}}
                        @endforeach
                    </span>  --}}
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
                            <td class="text-end">
                                <div class="row align-items-start form-check form-switch">
                                    <div class="col ">
                                        {{--  @dd($json);  --}}


                                        {{--  <input data-ids="{{$item->id_user}}" class="form-check-input" type="checkbox" data-onstyle="success" {{ $item->is_active ? 'checked' : '' }}>  --}}
                                        <span class="badge badge-pill badge-soft-success dataExp btn btn-blue" id="demo{{$item->user_id}}{{$item->produk_id}}">Paid</span>
                                        {{--  <button type="button" data-ids="{{$item->id_user}}" data-uid="{{$item->user_id}}" data-pid="{{$item->produk_id}}"  class="tes" id="dataExp" onclick="myfunction(this)" >Follow</button>  --}}
                                        <button data-uid="{{$item->user_id}}" class="tes" data-pid="{{$item->produk_id}}" id="dataExp"> CLICK</button>
                                        @if (preg_match("/_/",$item->nama_toko))
                                        <a href="https://wbslink.id/{{$item->nama_toko}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>
                                        @else
                                        <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>
                                        @endif
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id_user}})"
                                            data-target="#DeleteModal" class="material-icons md-delete_outline">
                                            </a>
                                            <span>
                                                {{--  {{ file_get_contents('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='.$item->user_id.'&product_id='.$item->produk_id.'')}}  --}}
                                                 </span>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });


    const get_data = () => {
        return fetch ('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='+uid+'&product_id='+pid+'')
        .then(x => x.text())
        .then(y => document.getElementById("demo"+uid+pid+"").innerHTML = y);
    }
</script>
<script>

    {{--  window.onload =  --}}
    {{--  function myfunction() {  --}}



          $.noConflict();
          $(document).ready(function( $ ) {
            $.each($('.tes'), function(index, value) {
                console.log(index + ':' + $('#dataExp').data('uid'));
              });
        {{--  var uid = $('#dataExp').data('uid');
        var pid = $('#dataExp').data('pid');
        console.log(uid);
        console.log(pid);
        fetch ('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='+uid+'&product_id='+pid+'')
        .then(x => x.text())
        .then(y => document.getElementById("demo"+uid+pid+"").innerHTML = y);  --}}
    });
    {{--  };  --}}
    {{--  function myfunction(e){
        var uid = $(this).data('uid');
        var pid = $(this).data('pid');
        var uid = e.getAttribute('data-uid');
        var pid = e.getAttribute('data-pid');

        console.log(uid);
        console.log(pid);
        fetch ('https://wbslink.id/apiv2/user/getExpired?_key=WbsLinkV00&user_id='+uid+'&product_id='+pid+'')
        .then(x => x.text())
        .then(y => document.getElementById("demo"+uid+pid+"").innerHTML = y);
    }  --}}
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




