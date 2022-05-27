<h1>{{ $label }}</h1>

{{--  <header class="card card-body mb-4">
    <div class="row gx-10">
        <div class="col-lg-6 col-md-10 me-auto">
            <p>KET</p>
           <table>
               <tr>
                   <th width="40%"><span class="badge rounded-pill alert-success"> </span> : Berlangganan</th>
                   <th width="30%"><span class="badge rounded-pill alert-danger"> </span> : Expired </th>
                   <th ><span class="badge rounded-pill alert-warning"> </span> : 7 Hari Sebelum Expired</th>
               </tr>
           </table>


        </div>
        <div class="col-lg-2 col-6 col-md-3">
            <select class="form-select">
                <option>Latest added</option>
                <option>Cheap first</option>
                <option>Most viewed</option>
            </select>
        </div>
    </div>
</header>  --}}
{{--  @dump($akun)  --}}
<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th  width="50%">Nama Lengkap</th>
                        {{--  <th>Tanggal Expired</th>  --}}
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Total Transaksi</th>
                        <th width="20%" class="text-center">Action</th>
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
                            <td >
                                <a href="{{ route( 'akun.show', $item->id_user) }}">
                                    <h6>{{ $item->nama_lengkap }}</h6></a></td>
                            {{--  <td>
                                <a href="{{ route( 'akun.show', $item->id_user) }}">

                                @if ( $item->selisih  > 7 )
                                <span class="badge rounded-pill alert-success">{{$item->tgl_expired}}</span>

                                @elseif($item->selisih  < 1)
                                <span class="badge rounded-pill alert-danger">{{$item->tgl_expired}}</span>
                                @elseif($item->selisih  < 7)
                                    <span class="badge rounded-pill alert-warning">{{$item->tgl_expired}}</span>
                                @endif
                                </a>
                            </td>  --}}
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td></td>
                            <td class="text-end">
                                <div class="row align-items-start form-check form-switch">
                                    <div class="col ">
                                        <input data-ids="{{$item->id_user}}" class="form-check-input" type="checkbox" data-onstyle="success" {{ $item->is_active ? 'checked' : '' }}>
                                        <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id_user}})"
                                            data-target="#DeleteModal" class="material-icons md-delete_outline">
                                            </a>
                                    </div>
                                </div>

                                {{--  <a href="{{ route( 'akun.destroy', $item->id_user) }} "  class="material-icons md-delete_outline">
                                    </a>  --}}

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

<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

