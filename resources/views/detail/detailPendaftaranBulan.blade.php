<div class="content-header">
    <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i>Kembali </a>
</div>
<h1>{{ $label }}{{$namaBulan}}</h1>

<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Usaha</th>
                        <th>Email</th>
                        <th>No hp</th>
                        <th>Alamat</th>
                        <th>Tanggal Daftar</th>
                        <th>Link Toko</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ( $userMonth as $key => $item )
                        <td>{{++$key}}</td>
                        <td>{{$item->nama_lengkap}}</td>
                        <td>{{$item->nama_toko}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->no_hp}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->is_created}}</td>
                        <td>
                            @if (preg_match("/_/",$item->nama_toko))
                            <a href="https://wbslink.id/{{$item->nama_toko}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>
                            @else
                            <a href="https://wbslink.id/{{Str::slug($item->nama_toko)}}" target="_blank" title="{{ $item->nama_lengkap }}" alamat="{{$item->alamat}}" ><i class="material-icons md-open_in_browser"></i></a>
                            @endif
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

